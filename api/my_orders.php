<?php
include "../config/db.php";

$user_id = $_GET['user_id'] ?? '';

if ($user_id == '') {
    echo json_encode([
        "status" => "error",
        "message" => "User id required"
    ]);
    exit;
}

$result = mysqli_query(
    $conn,
    "SELECT b.*, e.name, e.image_url
     FROM bookings b
     JOIN equipment e ON b.equipment_id = e.id
     WHERE b.user_id = '$user_id'
     ORDER BY b.id DESC"
);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
?>

