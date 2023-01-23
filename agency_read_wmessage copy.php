<?php
include './database/config.php';

$room_id = $_GET['room_id'];
$agency_id = $_GET['agency_id'];
$worker_id = $_GET['worker_id'];

$query = "UPDATE messages SET agency_read = 1 where agency_id = $agency_id and room_id=$room_id";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
        header("Location: agency_wmessages.php?room_id=$room_id");
      
    }
?>
