<?php
session_start();
include "../config/db.php";

/*
 If you are using sessions
*/
session_unset();
session_destroy();

/*
 If you are using token-based login,
 just return success and clear token on app side
*/

echo json_encode([
    "status" => "success",
    "message" => "Admin logged out successfully"
]);
?>
