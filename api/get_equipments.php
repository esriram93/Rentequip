<?php
include "db.php";
error_reporting(0); // Suppress warnings to prevent invalid JSON

$result = $conn->query("SELECT *, availability AS is_available FROM equipment");

$data = [];
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = "$protocol://$host/equip_rental_api/uploads/";

while ($row = $result->fetch_assoc()) {
    // Sanitizing data to prevent crashes on Android
    $row['id'] = (string)$row['id'];
    $row['name'] = (string)($row['name'] ?? 'Unknown');
    $row['description'] = (string)($row['description'] ?? '');
    $row['highlights'] = (string)($row['highlights'] ?? '');
    $row['price_per_day'] = (string)($row['price_per_day'] ?? '0');
    $row['category'] = (string)($row['category'] ?? 'General');
    $row['is_available'] = (string)($row['is_available'] ?? '1'); // Default to 1 (available) if missing
    
    // Image handling
    $img = $row['image_url'] ?? '';
    if ($img && trim($img) !== '') {
        $row['image_url'] = $base_url . $img;
    } else {
        $row['image_url'] = ''; // Empty string so Glide uses placeholder
    }

    $data[] = $row;
}

if (empty($data)) {
    echo json_encode([]);
} else {
    echo json_encode($data);
}
?>
