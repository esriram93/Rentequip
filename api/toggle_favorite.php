<?php
include "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'] ?? '';
$equipment_id = $data['equipment_id'] ?? '';

$check = mysqli_query(
    $conn,
    "SELECT * FROM favorites WHERE user_id='$user_id' AND equipment_id='$equipment_id'"
);

if (mysqli_num_rows($check) > 0) {
    mysqli_query(
        $conn,
        "DELETE FROM favorites WHERE user_id='$user_id' AND equipment_id='$equipment_id'"
    );
    echo json_encode(["status" => "removed"]);
} else {
    mysqli_query(
        $conn,
        "INSERT INTO favorites (user_id, equipment_id) VALUES ('$user_id', '$equipment_id')"
    );
    echo json_encode(["status" => "added"]);
}
?>
