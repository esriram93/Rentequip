<?php
include "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM equipment");

$equipments = [];

while ($row = mysqli_fetch_assoc($result)) {
    $equipments[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $equipments
]);
?>
