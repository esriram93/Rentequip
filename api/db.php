<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("localhost","root","","rent_equip");
if ($conn->connect_error) {
    echo json_encode(["status"=>"error","message"=>"Database connection failed"]);
    exit;
}
