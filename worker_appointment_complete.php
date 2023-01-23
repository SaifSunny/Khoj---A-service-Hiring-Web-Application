<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE appointments SET `status` = '3' WHERE appointment_id='$did'";
  $query_run = mysqli_query($conn, $query);

  $query1 = "UPDATE work_assign SET `status` = '1' WHERE appointment_id='$did'";
  $query_run1 = mysqli_query($conn, $query1);
  if ($query_run && $query_run1) {   

    echo "<script> 
    alert('Job Successfully Marked Completed.');
    window.location.href='worker_appointment.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Mark Completed the Job');
      window.location.href='worker_appointment.php';
      </script>";
  } 
?>