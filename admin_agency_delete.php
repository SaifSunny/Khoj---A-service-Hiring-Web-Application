<?php
include './database/config.php';

$did = $_GET['id'];

$query = "DELETE FROM agency WHERE agency_id='$did'";
$query_run = mysqli_query($conn, $query);
    if ($query_run) {
      echo "<script> 
      alert('Agency has been Deleted.');
      window.location.href='admin_agencies.php';
      </script>";
      
    } else {
      echo "<script>alert('Cannot Delete Agency');
      window.location.href='admin_agencies.php';
      </script>";
    }
?>
