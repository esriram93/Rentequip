<?php
include "../config/db.php";

// Suppress direct output of errors to prevent JSON corruption
error_reporting(0);
ini_set('display_errors', 0);

$data = json_decode(file_get_contents("php://input"), true);

$user_id        = $data['user_id'] ?? '';
$equipment_id   = $data['equipment_id'] ?? '';
$check_in_date  = $data['check_in_date'] ?? '';
$check_out_date = $data['check_out_date'] ?? '';
$advance_amount = $data['advance_amount'] ?? 0;

if ($user_id == '' || $equipment_id == '' || $check_in_date == '' || $check_out_date == '') {
    die(json_encode([
        "status" => "error",
        "message" => "All fields required"
    ]));
}

/* get price per day using prepared statement */
$stmtPrice = $conn->prepare("SELECT price_per_day FROM equipment WHERE id=?");
$stmtPrice->bind_param("i", $equipment_id);
$stmtPrice->execute();
$priceResult = $stmtPrice->get_result();
if ($priceResult->num_rows == 0) {
    die(json_encode(["status" => "error", "message" => "Equipment not found"]));
}
$priceRow = $priceResult->fetch_assoc();
$price_per_day = (double)$priceRow['price_per_day'];

/* calculate number of days */
$days = (strtotime($check_out_date) - strtotime($check_in_date)) / (60 * 60 * 24) + 1;
$total_amount = $days * $price_per_day;

/* insert booking using prepared statement */
$stmtInsert = $conn->prepare(
    "INSERT INTO bookings (user_id, equipment_id, check_in_date, check_out_date, total_amount, advance_amount, status) VALUES (?, ?, ?, ?, ?, ?, 'booked')"
);
$stmtInsert->bind_param("iissdd", $user_id, $equipment_id, $check_in_date, $check_out_date, $total_amount, $advance_amount);

if ($stmtInsert->execute()) {
    $booking_id = $conn->insert_id;

    // Update equipment availability
    $stmtUpdate = $conn->prepare("UPDATE equipment SET is_available = 0 WHERE id = ?");
    $stmtUpdate->bind_param("i", $equipment_id);
    $stmtUpdate->execute();

    echo json_encode([
        "status" => "success",
        "message" => "Booking successful",
        "booking_id" => (string)$booking_id,
        "total_amount" => $total_amount
    ]);

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Booking failed"
    ]);
}
?>
