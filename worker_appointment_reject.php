<?php
include './database/config.php';

$did = $_GET['id'];
$worker_id = $_GET['worker_id'];

  $query = "UPDATE appointments SET `status` = '1' WHERE appointment_id='$did'";
  $query_run = mysqli_query($conn, $query);

  $query1 = "DELETE FROM work_assign WHERE appointment_id='$did' and worker_id='$worker_id'";
  $query_run1 = mysqli_query($conn, $query1);

  if ($query_run && $query_run1) {   

    echo "<script> 
    alert('Job Successfully Cancelled.');
    window.location.href='worker_appointments.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Cancel the Job');
      window.location.href='worker_appointments.php';
      </script>";
  }
?>