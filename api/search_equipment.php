<?php
include "../config/db.php";

$keyword = $_GET['q'] ?? '';

$result = mysqli_query(
    $conn,
    "SELECT * FROM equipment WHERE name LIKE '%$keyword%'"
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
