<?php
include "../config/db.php";

$booking_id = $_GET['booking_id'] ?? '';

if ($booking_id == '') {
    echo json_encode([
        "status" => "error",
        "message" => "Booking ID required"
    ]);
    exit;
}

/* PAYMENT */
$paymentQuery = mysqli_query(
    $conn,
    "SELECT transaction_id, amount, payment_method, created_at 
     FROM payments
     WHERE booking_id = '$booking_id'
       AND payment_status = 'paid'
     ORDER BY created_at DESC
     LIMIT 1"
);

if (!$paymentQuery || mysqli_num_rows($paymentQuery) == 0) {
    echo json_encode([
        "status" => "error",
        "message" => "No payment found for this booking"
    ]);
    exit;
}

$payment = mysqli_fetch_assoc($paymentQuery);

/* EQUIPMENT */
$equipQuery = mysqli_query(
    $conn,
    "SELECT e.name 
     FROM bookings b
     JOIN equipment e ON e.id = b.equipment_id
     WHERE b.id = '$booking_id'
     LIMIT 1"
);

$equipment_name = "Unknown Equipment";
if ($equipQuery && mysqli_num_rows($equipQuery) > 0) {
    $equip = mysqli_fetch_assoc($equipQuery);
    $equipment_name = $equip['name'];
}

/* RESPONSE */
echo json_encode([
    "status" => "success",
    "equipment_name" => $equipment_name,
    "transaction_id" => $payment['transaction_id'],
    "amount" => $payment['amount'],
    "payment_method" => $payment['payment_method'],
    "date" => date("Y-m-d", strtotime($payment['created_at'])),
    "time" => date("H:i:s", strtotime($payment['created_at']))
]);
?>
