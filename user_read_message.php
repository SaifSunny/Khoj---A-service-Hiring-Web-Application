<?php
include './database/config.php';

$room_id = $_GET['room_id'];
$user_id = $_GET['user_id'];

$query = "UPDATE messages SET user_read = 1 where user_id = $user_id and room_id=$room_id";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
        header("Location: user_messages.php?room_id=$room_id");
      
    }
?>
