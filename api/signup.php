<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "rent_equip");

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$password = $data['password'] ?? '';
$repassword = $data['repassword'] ?? '';

if ($name == '' || $email == '' || $phone == '' || $password == '' || $repassword == '') {
    echo json_encode(["status" => "error", "message" => "All fields required"]);
    exit;
}

if ($password !== $repassword) {
    echo json_encode(["status" => "error", "message" => "Passwords do not match"]);
    exit;
}

$check = $conn->prepare("SELECT id FROM users WHERE email=?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Email already registered"]);
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $hashed);

if ($stmt->execute()) {
    $user_id = $stmt->insert_id;

    // Enable error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    file_put_contents("debug_log.txt", date("[Y-m-d H:i:s] ") . "Signup.php started\n", FILE_APPEND);

    $cust = $conn->prepare("INSERT INTO customers (user_id, name, email, phone) VALUES (?, ?, ?, ?)");
    $cust->bind_param("isss", $user_id, $name, $email, $phone);
    if (!$cust->execute()) {
        file_put_contents("debug_log.txt", "Signup.php Customer Error: " . $cust->error . "\n", FILE_APPEND);
    }

    echo json_encode(["status" => "success", "message" => "Signup successful"]);
} else {
    echo json_encode(["status" => "error", "message" => "Signup failed"]);
}
?>
