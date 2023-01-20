<?php 
date_default_timezone_set('Asia/Dhaka');

$server = "localhost";
$user = "root";
$pass = "";
$database = "khoj";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>