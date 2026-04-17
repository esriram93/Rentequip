<?php
include "db.php";
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $table = $row[0];
    echo "--- Table: $table ---\n";
    $fields = $conn->query("DESCRIBE $table");
    while ($field = $fields->fetch_assoc()) {
        echo $field['Field'] . " - " . $field['Type'] . "\n";
    }
    echo "\n";
}
?>
