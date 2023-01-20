<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM workers WHERE worker_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Worker has been Deleted.');
      window.location.href='agency_workers.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Worker');
      window.location.href='agency_workers.php';
      </script>";
    }
?>
