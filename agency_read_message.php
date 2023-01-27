<?php
include './database/config.php';
error_reporting(0);

$room_id = $_GET['room_id'];
$agency_id = $_GET['agency_id'];

$query = "UPDATE messages SET agency_read = 1 where agency_id = $agency_id and room_id=$room_id";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
        header("Location: agency_messages.php?room_id=$room_id");
      
    }
?>
