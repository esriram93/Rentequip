<?php
header("Content-Type: application/json");

// Suppress direct output of errors to prevent JSON corruption
error_reporting(0);
ini_set('display_errors', 0);

if (!function_exists('log_debug')) {
    function log_debug($msg) {
        file_put_contents("debug_log.txt", date("[Y-m-d H:i:s] ") . $msg . "\n", FILE_APPEND);
    }
}

log_debug("Script started. Method: " . $_SERVER['REQUEST_METHOD']);

require_once __DIR__ . "/../config/db.php";

$input = file_get_contents("php://input");
log_debug("Input: " . $input);
$data = json_decode($input, true);

if (!is_array($data)) {
    log_debug("Error: Invalid JSON");
    die(json_encode(["status"=>"error","message"=>"Invalid JSON"]));
}

$name     = trim($data['name'] ?? '');
$email    = trim($data['email'] ?? '');
$phone    = trim($data['phone'] ?? ''); // Android sends 'phone'
$password = trim($data['password'] ?? '');

log_debug("Parsed: Name=$name, Email=$email, Phone=$phone");

if ($name === '' || $email === '' || $password === '') {
    log_debug("Error: Missing fields");
    die(json_encode(["status"=>"error","message"=>"Missing required fields"]));
}

// Check duplicate email
$check = $conn->prepare("SELECT id FROM users WHERE email=?");
if (!$check) {
    log_debug("Error: DB Prepare Check Failed: " . $conn->error);
    die(json_encode(["status"=>"error","message"=>"DB Error"]));
}
$check->bind_param("s", $email);
$check->execute();
$check->store_result();
if ($check->num_rows > 0) {
    log_debug("Error: Email already exists");
    die(json_encode(["status"=>"error","message"=>"Email already exists"]));
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

// Database has 'mobile' column, not 'phone'
$stmt = $conn->prepare(
    "INSERT INTO users (name, email, mobile, password) VALUES (?, ?, ?, ?)"
);
if (!$stmt) {
     log_debug("Error: DB Prepare Insert Failed: " . $conn->error);
     die(json_encode(["status"=>"error","message"=>"DB Error"]));
}
$stmt->bind_param("ssss", $name, $email, $phone, $hashed);

if ($stmt->execute()) {
    $user_id = $conn->insert_id;
    log_debug("Success: User $user_id created in users table");

    try {
        // Insert into customers table
        // Verified columns: id, user_id, name, email, phone
        $customerStmt = $conn->prepare(
            "INSERT INTO customers (user_id, name, email, phone) VALUES (?, ?, ?, ?)"
        );
        if ($customerStmt) {
            $customerStmt->bind_param("isss", $user_id, $name, $email, $phone);
            if (!$customerStmt->execute()) {
                 log_debug("Error: Customer Insert Execute Failed: " . $customerStmt->error);
            } else {
                log_debug("Success: Customer record created");
            }
        } else {
             log_debug("Error: Customer Prepare Failed: " . $conn->error);
        }
    } catch (Exception $e) {
        log_debug("Warning: Customer insert failed: " . $e->getMessage());
    }
    
    echo json_encode(["status"=>"success"]);
} else {
    log_debug("Error: Insert Execute Failed: " . $stmt->error);
    echo json_encode(["status"=>"error","message"=>"Registration failed"]);
}
?>
