<?php
include "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM equipment");

$equipments = [];

while ($row = mysqli_fetch_assoc($result)) {
    $equipments[] = [
        "equipment_id" => $row['equipment_id'],
        "name" => $row['name'],
        "price" => $row['price'],
        "image" => $row['image'],
        "status" => $row['status']
    ];
}

echo json_encode([
    "status" => "success",
    "data" => $equipments
]);
?>
