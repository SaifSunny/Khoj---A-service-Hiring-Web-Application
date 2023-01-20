<?php
include_once("./database/config.php");

session_start();
$username = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
}

$sql = "SELECT * FROM `users` WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$image = $row['user_img'];
$user_id = $row['user_id'];
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$gender=$row['gender'];
$birthday=$row['birthday'];
$contact=$row['contact'];
$email=$row['email'];
$address=$row['address'];
$city=$row['city'];
$zip=$row['zip'];

$agency_id=$_GET['agency_id'];

$sql1 = "SELECT * FROM `agency` WHERE agency_id='$agency_id'";
$result1 = mysqli_query($conn, $sql1);
$row1=mysqli_fetch_assoc($result1);
$agency_name=$row1['agency_name'];


if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $appointment_datetime=$_POST['a_date']." ".$_POST['a_time'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];
    $address=$_POST['address']." ".$_POST['city']." ".$_POST['zip'];
    $cost=$_POST['cost'];

    $error = "";
    $cls="";

    $sql = "SELECT * FROM appointments WHERE user_id='$user_id' and title='$title' and appointment_datetime='$appointment_datetime'";
	$result = mysqli_query($conn, $sql);

	if (!$result->num_rows > 0) {

        // INSERT Record
        $query2 = "INSERT INTO appointments(user_id, agency_id, title, `description`,appointment_datetime, cost, `address`, email, contact) 
        VALUES('$user_id','$agency_id','$title','$description','$appointment_datetime','$cost','$address','$email','$contact')";
	    $query_run2 = mysqli_query($conn, $query2);

        
        if ($query_run2) {
            $cls="success";
            $error = "Appointment Successfully Placed.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }
    }else{
        $error = "Appointment Already Exists";
        $cls="danger";
    }

}


$sql22 = "SELECT * FROM messages WHERE user_id='$user_id'";
$result22 = mysqli_query($conn, $sql22);
$row22=mysqli_fetch_assoc($result22);

$user_read = $row22['user_read'];
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Khoj - Service Hiring App</title>

    <!-- Custom CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/fonts/themify-icons/themify-icons.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>


    <div id="main-wrapper">

        <div class="dashboard-wrap bg-light">

            <!-- Start Navigation -->
            <a class="mobNavigation" data-toggle="collapse" href="#MobNav" role="button" aria-expanded="false"
                aria-controls="MobNav">
                <i class="fas fa-bars mr-2"></i>Dashboard Navigation
            </a>
            <div class="collapse" id="MobNav">
                <div class="dashboard-nav">
                    <div class="dashboard-inner">
                        <a class="nav-brand" href="#">
                            <img src="assets/img/logo.png" class="logo" alt="" style="margin: 20px 40px;" />
                        </a>
                        <ul data-submenu-title="Main Navigation">
                            <li><a href="user_home.php"><i
                                        class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                            <li class="active"><a href="user_find_help.php"><i class="lni lni-files mr-2"></i>Find Help</a>
                            </li>
                            <?php
                            if($user_read==0){
                                $sql = "SELECT * from messages where user_id = $user_id and `user_read` = 0";
                                $result = mysqli_query($conn, $sql);
                                $row_cnt = $result->num_rows;
                            ?>
                            <li class=""><a href="user_chat.php"><i
                                        class="lni lni-envelope mr-2"></i>Messages<span
                                        class="count-tag"><?php echo $row_cnt?></span></a>
                            </li>
                            <?php
                            }else{
                            ?>
                            <li class=""><a href="user_chat.php"><i class="lni lni-envelope mr-2"></i>Messages</a>
                            </li>
                            <?php
                            }
                            ?>
                            <li><a href="user_appointment.php"><i class="lni lni-bookmark mr-2"></i>My
                                    Appointments</a></li>
                            <li><a href="user_hiring.php"><i class="lni lni-briefcase mr-2"></i>My Hirings</a></li>


                        </ul>
                        <ul data-submenu-title="My Accounts">
                            <li ><a href="user_profile.php"><i class="lni lni-user mr-2"></i>My Profile </a>
                            </li>
                            </li>
                            <li><a href="user_logout.php"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Navigation -->

            <div class="dashboard-content">
                <div class="dashboard-tlbar d-block mb-5">
                    <div class="row">
                        <div class="colxl-10 col-lg-10 col-md-8">
                            <h1 class="ft-medium">Schedule Appointment</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                <li class="breadcrumb-item text-muted"><a href="user_home.php"
                                            class="theme-cl">Dashboard</a> </li>
                                            <li class="breadcrumb-item text-muted"><a href="user_agency_profile.php"
                                            class="theme-cl">Find Agency</a> </li>
                                    <li class="breadcrumb-item">Schedule Appointment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="dashboard-widg-bar d-block">
                    
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="_dashboard_content bg-white rounded">

                                <div class="_dashboard_content_body py-3">
                                    <div class="row">
                                        <div class="col-md-12" style="padding-left:40px;">
                                            <form action="" method="POST" enctype='multipart/form-data'
                                                style="margin: 0 40px;">

                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="alert alert-<?php echo $cls;?>" style="margin:10px 0">
                                                        <?php 
                                                        if (isset($_POST['submit'])){
                                                            echo $error;
                                                        }
                                                    ?>
                                                    </div>
                                                    <div class="row" style="color:black">
                                                        <div class="col-md-12">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Agency Name</label>
                                                                <input type="text" class="form-control" name="agency_name"
                                                                    id="agency_name" placeholder="Agency Name" value="<?php echo $agency_name?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Appointment Title</label>
                                                                <input type="text" class="form-control" name="title"
                                                                    id="title" placeholder="Appointment Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Offered Ammont (Tk.)</label>
                                                                <input type="text" class="form-control" name="cost"
                                                                    id="cost" placeholder="Enter Ammont">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Appointment Date</label>
                                                                <input type="date" class="form-control" name="a_date"
                                                                    id="a_date" placeholder="a_date" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Appointment Time</label>
                                                                <input type="time" class="form-control" name="a_time"
                                                                    id="a_time" placeholder="a_time" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Contact</label>
                                                                <input type="text" class="form-control" name="contact"
                                                                    id="contact" placeholder="Contact" value="<?php echo $contact?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Email</label>
                                                                <input type="text" class="form-control" name="email"
                                                                    id="email" placeholder="Email" value="<?php echo $email?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" name="address"
                                                                    id="address" placeholder="Address" value="<?php echo $address?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>City</label>
                                                                <input type="text" class="form-control" name="city"
                                                                    id="city" placeholder="City" value="<?php echo $city?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Zip</label>
                                                                <input type="text" class="form-control" name="zip"
                                                                    id="zip" placeholder="Zip" value="<?php echo $zip?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Describe the Work Details</label>
                                                                <textarea class="form-control" name="description"
                                                                    id="description" placeholder="Describe the Work Details"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12">
                                                            <div class="form-group">

                                                                <button type="submit" name="submit"
                                                                    class="btn btn-md ft-medium text-light rounded theme-bg">Schedule</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>


            </div>

        </div>
        <!-- ======================= dashboard Detail End ======================== -->


    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/slider-bg.js"></script>
    <script src="assets/js/smoothproducts.js"></script>
    <script src="assets/js/snackbar.min.js"></script>
    <script src="assets/js/jQuery.style.switcher.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->

</body>

</html>