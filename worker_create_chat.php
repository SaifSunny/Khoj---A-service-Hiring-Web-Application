<?php
include './database/config.php';

  $agency_id = $_GET['agency_id'];
  $worker_id = $_GET['worker_id'];
  $appointment_id = $_GET['id'];

  $date=date("l jS \ F Y h:i A");
  $datetime=date("h:i:sa");

  $sql = "SELECT * FROM appointments where appointment_id = '$appointment_id'";
  $result = mysqli_query($conn, $sql);
  $row=mysqli_fetch_assoc($result);

  $title=$row['title'];
  $appointment_datetime=$row['appointment_datetime'];
  $cost=$row['cost'];
  $contact=$row['contact'];
  $address=$row['address'];

  $sql = "SELECT * FROM w_chat_room WHERE worker_id='$worker_id' AND agency_id='$agency_id'";
	$result = mysqli_query($conn, $sql);

  if(!$result->num_rows > 0){
    $sql = "INSERT INTO w_chat_room(worker_id, agency_id, create_date) VALUES ('$worker_id', '$agency_id', '$date')";
    $result = mysqli_query($conn, $sql);


    if($result){

      $sql2 = "SELECT * from w_chat_room WHERE worker_id='$worker_id' AND agency_id='$agency_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2=mysqli_fetch_assoc($result2);
      $room_id=$row2['room_id'];

      
      $sql3 = "INSERT INTO w_messages(room_id,worker_id,agency_id,message,send_time,sender)
      VALUES ('$room_id', '$worker_id','$agency_id','Job Title:$title <br> Date: $appointment_datetime <br>Payment: $cost <br>Contact: $contact <br>Address: $address', '$datetime', '0')";
      $result3 = mysqli_query($conn, $sql3);
      if($result){
        header("Location: worker_chat.php");
      }
    }
  }else{
    header("Location: worker_chat.php");
  }
?>