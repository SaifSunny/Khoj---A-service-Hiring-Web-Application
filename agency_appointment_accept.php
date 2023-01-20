<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE appointments SET `status` = '1' WHERE appointment_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Job Successfully Accepted.');
    window.location.href='agency_appointments.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Accept the Job');
      window.location.href='agency_appointments.php';
      </script>";
  }
?>