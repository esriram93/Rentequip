<?php
include "db.php";
$result = $conn->query("DESCRIBE equipment");
while($row = $result->fetch_assoc()) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
?>
