<?php
include "../config/db.php";

$user_id = $_GET['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT e.* FROM equipment e
     JOIN favorites f ON e.id = f.equipment_id
     WHERE f.user_id = '$user_id'"
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
