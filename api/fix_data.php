<?php
include "db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Update all records with empty images to have a default one
$sql = "UPDATE equipment SET image_url='excavator.jpg' WHERE image_url IS NULL OR image_url = ''";

if ($conn->query($sql) === TRUE) {
    echo "Updated " . $conn->affected_rows . " records with default image.";
} else {
    echo "Error updating records: " . $conn->error;
}
?>
