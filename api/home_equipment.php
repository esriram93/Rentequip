<?php
include "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM equipment");

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        "id" => $row['id'],
        "name" => $row['name'],
        "description" => $row['description'],
        "price_per_day" => $row['price_per_day'],
        "image_url" => $row['image_url'],
        "is_available" => $row['is_available']
    ];
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
?>
