<?php
include './database/config.php';

$room_id = $_GET['room_id'];
$worker_id = $_GET['worker_id'];

$query = "UPDATE w_messages SET worker_read = 1 where worker_id = $worker_id and room_id=$room_id";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
        header("Location: worker_messages.php?room_id=$room_id");
      
    }
?>
