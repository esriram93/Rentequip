<?php
include "db.php";

echo "Starting schema fix...\n";

// Add user_id to customers if it doesn't exist
$check_column = $conn->query("SHOW COLUMNS FROM customers LIKE 'user_id'");
if ($check_column->num_rows == 0) {
    $sql = "ALTER TABLE customers ADD COLUMN user_id INT(11) AFTER id";
    if ($conn->query($sql)) {
        echo "Column 'user_id' added successfully to 'customers'.\n";
    } else {
        echo "Error adding column: " . $conn->error . "\n";
    }
} else {
    echo "Column 'user_id' already exists in 'customers'.\n";
}

// Add index/foreign key if needed (optional for now to simplify)
// $conn->query("ALTER TABLE customers ADD FOREIGN KEY (user_id) REFERENCES users(id)");

echo "Schema fix completed.\n";
?>
