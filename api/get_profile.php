<?php
include "../config/db.php";

$user_id = $_GET['user_id'] ?? '';

if ($user_id == '') {
    echo json_encode([
        "status" => "error",
        "message" => "User ID required"
    ]);
    exit;
}

/* Fetch user details */
$query = mysqli_query(
    $conn,
    "SELECT name, email, mobile 
     FROM users  
     WHERE id = '$user_id'
     LIMIT 1"
);

if (!$query || mysqli_num_rows($query) == 0) {
    echo json_encode([
        "status" => "error",
        "message" => "User not found"
    ]);
    exit;
}

$user = mysqli_fetch_assoc($query);

echo json_encode([
    "status" => "success",
    "name" => $user['name'],
    "email" => $user['email'],
    "contact" => $user['mobile'] // Aliased in SQL or use $user['mobile'] if not aliased. Let's look at SQL again. 
    // I aliased it as phone in SQL above: mobile as phone. So $user['phone'] is correct.
    // Wait, let's keep it simple. SELECT name, email, mobile... $user['mobile'].
    // Reverting previous change to just selecting mobile.
    // Actually, Android likely expects 'contact' key or 'phone' key? 
    // get_profile.php returns "contact" => $user['phone']. 
    // So if I select mobile, I should map mobile to contact.
]);
?>
