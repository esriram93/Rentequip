<?php
include "../config/db.php";

$status = $_GET['status'] ?? 'All';

/*
 Allowed values:
 All | Pending | Accepted | Rejected
*/

$sql = "
SELECT 
    b.id AS booking_id,
    b.check_in_date,
    b.check_out_date,
    b.status,
    e.name AS equipment_name
FROM bookings b
JOIN equipment e ON b.equipment_id = e.id
";

if ($status !== 'All') {
    $sql .= " WHERE b.status = '$status'";
}

$sql .= " ORDER BY b.created_at DESC";

$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $data
]);
