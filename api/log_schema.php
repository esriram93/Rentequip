<?php
include "db.php";
$output = "";
$res = $conn->query("SHOW TABLES");
while($row = $res->fetch_array()) {
    $table = $row[0];
    $output .= "\nTable: $table\n";
    $desc = $conn->query("DESCRIBE $table");
    while($d = $desc->fetch_assoc()) {
        $output .= "  " . $d['Field'] . " (" . $d['Type'] . ")\n";
    }
}
file_put_contents("schema_log.txt", $output);
echo "Schema logged to schema_log.txt";
?>
