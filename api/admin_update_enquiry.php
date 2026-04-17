<?php
include "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$booking_id = $data['booking_id'] ?? '';
$action     = $data['action'] ?? '';

if ($booking_id === '' || $action === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Booking ID and action required"
    ]);
    exit;
}

if (!in_array($action, ['accepted', 'rejected'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid action"
    ]);
    exit;
}

/* 1️⃣ Update booking status */
mysqli_query(
    $conn,
    "UPDATE bookings SET status='$action' WHERE id='$booking_id'"
);

/* 2️⃣ Safely fetch user + equipment */
$user_id = null;
$equipment_name = "your equipment";

$infoQuery = mysqli_query(
    $conn,
    "SELECT b.user_id, e.name AS equipment_name
     FROM bookings b
     LEFT JOIN equipment e ON e.id = b.equipment_id
     WHERE b.id='$booking_id'
     LIMIT 1"
);

if ($infoQuery) {
    $info = mysqli_fetch_assoc($infoQuery);

    if (is_array($info)) {
        if (isset($info['user_id'])) {
            $user_id = $info['user_id'];
        }
        if (!empty($info['equipment_name'])) {
            $equipment_name = $info['equipment_name'];
        }
    }
}

/* 3️⃣ Insert notification ONLY if user exists */
if ($user_id !== null) {

    if ($action === 'accepted') {
        $title = "Booking Approved";
        $message = "Your booking for $equipment_name has been approved by admin.";
    } else {
        $title = "Booking Rejected";
        $message = "Your booking for $equipment_name has been rejected by admin.";
    }

    mysqli_query(
        $conn,
        "INSERT INTO notifications (user_id, title, message)
         VALUES ('$user_id', '$title', '$message')"
    );
}

echo json_encode([
    "status" => "success",
    "message" => "Booking $action and user notified"
]);
?>
