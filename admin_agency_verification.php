<?php
include './database/config.php';

$did = $_GET['id'];

  $query = "UPDATE agency SET `status` = '1' WHERE agency_id='$did'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {   

    echo "<script> 
    alert('Verification Successfull.');
    window.location.href='admin_agencies.php';
    </script>";
    

  }else{
    echo "<script>alert('Cannot Confirm verification Request');
      window.location.href='admin_agencies.php';
      </script>";
  }
?>