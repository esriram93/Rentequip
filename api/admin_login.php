<?php
include "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$email    = $data['email'] ?? '';
$password = $data['password'] ?? '';

if ($email == '' || $password == '') {
    echo json_encode([
        "status" => "error",
        "message" => "Email and password required"
    ]);
    exit;
}

/* Check admin credentials */
$query = mysqli_query(
    $conn,
    "SELECT id, email 
     FROM admins 
     WHERE email = '$email' AND password = '$password'
     LIMIT 1"
);

if (mysqli_num_rows($query) == 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid admin credentials"
    ]);
    exit;
}

$admin = mysqli_fetch_assoc($query);

echo json_encode([
    "status" => "success",
    "message" => "Admin login successful",
    "admin_id" => $admin['id'],
    "email" => $admin['email']
]);
?>
