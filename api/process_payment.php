<?php
include "../config/db.php";

// Suppress direct output of errors to prevent JSON corruption
error_reporting(0);
ini_set('display_errors', 0);

$data = json_decode(file_get_contents("php://input"), true);

$booking_id     = $data['booking_id'] ?? '';
$user_id        = $data['user_id'] ?? '';
$amount         = $data['amount'] ?? '';
$payment_method = $data['payment_method'] ?? 'UPI';

if ($booking_id == '' || $user_id == '' || $amount == '') {
    die(json_encode([
        "status" => "error",
        "message" => "All fields required"
    ]));
}

$transaction_id = uniqid("TXN_");

/* 1️⃣ Insert payment using prepared statement */
$stmtPay = $conn->prepare("INSERT INTO payments (booking_id, user_id, amount, payment_method, payment_status, transaction_id) VALUES (?, ?, ?, ?, 'paid', ?)");
$stmtPay->bind_param("iidss", $booking_id, $user_id, $amount, $payment_method, $transaction_id);

if ($stmtPay->execute()) {
    /* 2️⃣ Update booking status to PAID */
    $stmtBooking = $conn->prepare("UPDATE bookings SET status='paid' WHERE id=?");
    $stmtBooking->bind_param("i", $booking_id);
    $stmtBooking->execute();

    /* 3️⃣ Mark equipment unavailable (it should already be marked, but we ensure it here) */
    $stmtEquip = $conn->prepare("UPDATE equipment SET is_available = 0 WHERE id = (SELECT equipment_id FROM bookings WHERE id=?)");
    $stmtEquip->bind_param("i", $booking_id);
    $stmtEquip->execute();

    echo json_encode([
        "status" => "success",
        "message" => "Payment successful",
        "transaction_id" => $transaction_id
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Payment processing failed"
    ]);
}
?>
