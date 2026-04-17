<?php
include "../config/db.php";

$user_id        = $_POST['user_id'] ?? '';
$equipment_id   = $_POST['equipment_id'] ?? '';
$check_in_date  = $_POST['check_in_date'] ?? '';
$check_out_date = $_POST['check_out_date'] ?? '';
$advance_amount = $_POST['advance_amount'] ?? 0;

/* Validation */
if ($user_id == '' || $equipment_id == '' || $check_in_date == '' || $check_out_date == '') {
    echo json_encode([
        "status" => "error",
        "message" => "All fields required"
    ]);
    exit;
}

/* Check equipment availability */
$equipQuery = mysqli_query(
    $conn,
    "SELECT price_per_day, is_available FROM equipment WHERE id='$equipment_id'"
);
$equip = mysqli_fetch_assoc($equipQuery);

if (!$equip || $equip['is_available'] == 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Equipment not available"
    ]);
    exit;
}

/* Calculate days */
$days = (strtotime($check_out_date) - strtotime($check_in_date)) / (60 * 60 * 24) + 1;
$total_amount = $days * $equip['price_per_day'];

/* Insert booking */
$insert = mysqli_query(
    $conn,
    "INSERT INTO bookings
    (user_id, equipment_id, check_in_date, check_out_date, total_amount, advance_amount, status)
    VALUES
    ('$user_id', '$equipment_id', '$check_in_date', '$check_out_date', '$total_amount', '$advance_amount', 'booked')"
);

/* Update availability */
if ($insert) {

    mysqli_query(
        $conn,
        "UPDATE equipment SET is_available = 0 WHERE id='$equipment_id'"
    );

    echo json_encode([
        "status" => "success",
        "message" => "Booking confirmed",
        "check_in" => $check_in_date,
        "check_out" => $check_out_date,
        "days" => $days,
        "price_per_day" => $equip['price_per_day'],
        "total_amount" => $total_amount,
        "advance_amount" => $advance_amount
    ]);

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Booking failed"
    ]);
}
?>
