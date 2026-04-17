<?php
include "../config/db.php";

// Suppress direct output of errors to prevent JSON corruption
error_reporting(0);
ini_set('display_errors', 0);

$data = json_decode(file_get_contents("php://input"), true);

$email    = $data['email'] ?? '';
$password = $data['password'] ?? '';

if ($email === "" || $password === "") {
    die(json_encode([
        "status" => "error",
        "message" => "All fields required"
    ]));
}

// Check user by email using prepared statement
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    // Verify Password
    if (password_verify($password, $user['password'])) {
        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "user" => [
                "id"   => $user['id'],
                "email" => $user['email'],
                "name"  => $user['name']
            ],
            "user_id" => $user['id'],
            "email"   => $user['email']
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid password"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "User not found"
    ]);
}
?>
