<?php
include "../config/db.php";

$user_id = $_GET['user_id'] ?? '';

if ($user_id == '') {
    echo json_encode([
        "status" => "error",
        "message" => "User ID required"
    ]);
    exit;
}

$result = mysqli_query($conn,
    "SELECT id, title, message, is_read, created_at
     FROM notifications
     WHERE user_id='$user_id'
     ORDER BY created_at DESC"
);

$notifications = [];

while ($row = mysqli_fetch_assoc($result)) {
    $notifications[] = $row;
}

echo json_encode([
    "status" => "success",
    "notifications" => $notifications
]);
?>
