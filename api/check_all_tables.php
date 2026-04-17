<?php
include "db.php";

$tables = ['users', 'equipment', 'bookings', 'payments', 'favorites', 'notifications'];

foreach ($tables as $table) {
    echo "\n--- Table: $table ---\n";
    $result = $conn->query("DESCRIBE $table");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo $row['Field'] . " - " . $row['Type'] . "\n";
        }
    } else {
        echo "Table does not exist!\n";
    }
}
?>
