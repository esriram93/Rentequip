<?php
include "db.php";

$statements = [
    "ALTER TABLE equipment ADD COLUMN highlights TEXT",
    "ALTER TABLE equipment ADD COLUMN is_available TINYINT(1) DEFAULT 1"
];

foreach ($statements as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Schema updated successfully.<br>";
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}
?>
