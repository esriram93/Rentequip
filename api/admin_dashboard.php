<?php
include "../config/db.php";

/* Total bookings */
$totalBookings = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT COUNT(*) AS total FROM bookings"
    )
)['total'];

/* Active (Accepted) bookings */
$activeBookings = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT COUNT(*) AS total 
         FROM bookings 
         WHERE status='accepted'"
    )
)['total'];

/* Total revenue (only accepted bookings) */
$totalRevenue = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT IFNULL(SUM(total_amount),0) AS total
         FROM bookings
         WHERE status='accepted'"
    )
)['total'];

/* Advance collected (only accepted bookings) */
$advanceCollected = mysqli_fetch_assoc(
    mysqli_query($conn,
        "SELECT IFNULL(SUM(advance_amount),0) AS total
         FROM bookings
         WHERE status='accepted'"
    )
)['total'];

echo json_encode([
    "status" => "success",
    "total_bookings" => $totalBookings,
    "active_bookings" => $activeBookings,
    "total_revenue" => $totalRevenue,
    "advance_collected" => $advanceCollected
]);
?>
