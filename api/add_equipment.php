<?php
header("Content-Type: application/json");

require_once __DIR__ . "/../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name     = trim($data['name'] ?? '');
$category = trim($data['category'] ?? '');
$price    = $data['price_per_day'] ?? 0;

if ($name === '' || $price <= 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid input"
    ]);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO equipment (name, category, price_per_day)
     VALUES (?, ?, ?)"
);
$stmt->bind_param("ssd", $name, $category, $price);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Insert failed"
    ]);
}
