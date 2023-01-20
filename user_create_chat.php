<?php
include './database/config.php';

  $agency_id = $_GET['agency_id'];
  $user_id = $_GET['user_id'];

  $date=date("l jS \ F Y h:i A");
  $datetime=date("h:i:sa");

  $sql = "SELECT * FROM chat_room WHERE user_id='$user_id' AND agency_id='$agency_id'";
	$result = mysqli_query($conn, $sql);

  if(!$result->num_rows > 0){
    $sql = "INSERT INTO chat_room(user_id, agency_id, create_date) VALUES ('$user_id', '$agency_id', '$date')";
    $result = mysqli_query($conn, $sql);


    if($result){

      $sql2 = "SELECT * from chat_room WHERE user_id='$user_id' AND agency_id='$agency_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2=mysqli_fetch_assoc($result2);
      $room_id=$row2['room_id'];

      
      $sql3 = "INSERT INTO messages(room_id,user_id,agency_id,message,send_time,sender)
      VALUES ('$room_id', '$user_id','$agency_id','hi', '$datetime', '0')";
      $result3 = mysqli_query($conn, $sql3);
      if($result){
        header("Location: user_chat.php");
      }
    }
  }else{
    header("Location: user_chat.php");
  }
?>