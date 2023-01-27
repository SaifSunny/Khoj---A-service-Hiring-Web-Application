<?php
    include_once("./database/config.php");

    session_start();
    error_reporting(0);

    $username = $_SESSION['agencyname'];

    if (!isset($_SESSION['agencyname'])) {
        header("Location: agency_login.php");
    }

    $sql = "SELECT * FROM agency WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);

    $_SESSION['image'] = $row['agency_img'];
    $_SESSION['agency_id'] = $row['agency_id'];
    $_SESSION['username'] = $row['username'];

    $agency_id = $row['agency_id'];
    $agency_img = $row['agency_img'];
    $zip = $row['zip'];

    $sql22 = "SELECT * FROM messages WHERE agency_id='$agency_id'";
    $result22 = mysqli_query($conn, $sql22);
    $row22=mysqli_fetch_assoc($result22);

    $user_read = $row22['agency_read'];

    $appointment_id = $_GET['id'];
    $error = "";
    $cls="";

    $sql1 = "SELECT * FROM `appointments` WHERE appointment_id='$appointment_id'";
    $result1 = mysqli_query($conn, $sql1);
    $row1=mysqli_fetch_assoc($result1);

    $user_id=$row1['user_id'];
    $title=$row1['title'];
    $appointment_datetime=$row1['appointment_datetime'];
    $cost=$row1['cost'];
    $contact=$row1['contact'];
    $email=$row1['email'];
    $address=$row1['address'];
    $status=$row1['status'];
    $description=$row1['description'];
    $datetime = explode(" ", $appointment_datetime);

    $sql1 = "SELECT * FROM users where user_id = '$user_id'";
    $result1 = mysqli_query($conn, $sql1);
    $row1=mysqli_fetch_assoc($result1);
    $user_name=$row1['firstname']." ".$row1['lastname'];
    $user_img=$row1['user_img'];
    $user_city=$row1['city'];

    
if (isset($_POST['submit'])) {

    $worker_id = $_POST['worker'];

    $error = "";
    $cls="";

    $sql = "SELECT * FROM work_assign WHERE worker_id='$worker_id' and appointment_id='$appointment_id'";
	$result = mysqli_query($conn, $sql);

	if (!$result->num_rows > 0) {

        // INSERT Record
        $query2 = "INSERT INTO work_assign(worker_id, appointment_id) 
        VALUES('$worker_id','$appointment_id')";
	    $query_run2 = mysqli_query($conn, $query2);

        $query3 = "UPDATE appointments SET `status` = '2' WHERE appointment_id='$appointment_id'";
	    $query_run3 = mysqli_query($conn, $query3);

        if ($query_run2 && $query_run3) {
            $cls="success";
            $error = "Job Successfully Assigned.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
        }
    }else{
        $error = "Job Already Assigned";
        $cls="danger";
    }

}

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



        <!-- ======================= dashboard Detail ======================== -->

        <div class="dashboard-wrap bg-light">

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
                            <li><a href="agency_home.php"><i class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                            <li class="active"><a href="agency_appointments.php"><i
                                        class="lni lni-files mr-2"></i>Manage Appointments</a></li>
                            <li><a href="agency_workers.php"><i class="lni lni-users mr-2"></i>Manage Workers</a></li>
                            <?php
                            if($user_read==0){
                                $sql = "SELECT * from messages where agency_id = $agency_id and `agency_read` = 0";
                                $result = mysqli_query($conn, $sql);
                                $row_cnt = $result->num_rows;
                            ?>
                            <li><a href="agency_chat.php"><i class="lni lni-envelope mr-2"></i>Messages<span
                                        class="count-tag"><?php echo $row_cnt?></span></a>
                            </li>
                            <?php
                            }else{
                            ?>
                            <li><a href="agency_chat.php"><i class="lni lni-envelope mr-2"></i>Messages</a>
                            </li>
                            <?php
                            }
                            ?>
                            <li><a href="agency_appointment_history.php"><i
                                        class="lni lni-bookmark mr-2"></i>Appointment History</a></li>
                        </ul>
                        <ul data-submenu-title="My Accounts">
                            <li><a href="agency_profile.php"><i class="lni lni-user mr-2"></i>My Profile </a>
                            </li>
                            </li>
                            <li><a href="agency_logout.php"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="dashboard-tlbar d-block mb-5">
                    <div class="row">

                        <div class="colxl-10 col-lg-10 col-md-8">
                            <h1 class="ft-medium">Manage Appointments</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="agency_home.php">Home</a></li>
                                    <li class="breadcrumb-item text-muted"><a href="agency_appointments.php"
                                            class="theme-cl">Manage Appointments</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="theme-cl">Manage Appointments</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="dashboard-widg-bar d-block">
                    <div class="row bg-white">
                        <div class="col-md-2" style="margin-top:60px">
                            <form action="" method="POST" enctype='multipart/form-data' style="margin: 20px;">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div style="width: 200px; height: 200px;">
                                        <img src="./assets/img/users/<?php echo $user_img?>" width="100%" height="100%"
                                            style="text-align:center;">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="_dashboard_content  rounded">

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
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Employer Name</label>
                                                                <input type="text" class="form-control" name="user_name"
                                                                    id="user_name" placeholder="Employer Name"
                                                                    value="<?php echo $user_name?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Assign Worker</label>
                                                                <select class="form-control" name="worker"
                                                                    id="worker" required>
                                                                    <option value="">-- Select Worker --</option>
                                                                    <?php
                                                                                $option = "SELECT * FROM workers";
                                                                                $option_run = mysqli_query($conn, $option);

                                                                                if (mysqli_num_rows($option_run) > 0) {
                                                                                    foreach ($option_run as $row2) {
                                                                                ?>
                                                                    <option value="<?php echo $row2['worker_id']; ?>">
                                                                        <?php echo $row2['firstname']." ".$row2['lastname'];?> (<?php echo $row2['specialization']?>)
                                                                    </option>
                                                                    <?php
                                                                                    }
                                                                                }
                                                                            ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Appointment Title</label>
                                                                <input type="text" class="form-control" name="title"
                                                                    id="title" placeholder="Appointment Title"
                                                                    value="<?php echo $title?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Offered Ammont (Tk.)</label>
                                                                <input type="text" class="form-control" name="cost"
                                                                    id="cost" placeholder="Enter Ammont"
                                                                    value="<?php echo $cost?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Appointment Date</label>
                                                                <input type="date" class="form-control" name="a_date"
                                                                    id="a_date" placeholder="a_date"
                                                                    value="<?php echo $datetime[0]?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Appointment Time</label>
                                                                <input type="time" class="form-control" name="a_time"
                                                                    id="a_time" placeholder="a_time"
                                                                    value="<?php echo $datetime[1]?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Contact</label>
                                                                <input type="text" class="form-control" name="contact"
                                                                    id="contact" placeholder="Contact"
                                                                    value="<?php echo $contact?>" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Email</label>
                                                                <input type="text" class="form-control" name="email"
                                                                    id="email" placeholder="Email"
                                                                    value="<?php echo $email?>" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" name="address"
                                                                    id="address" placeholder="Address"
                                                                    value="<?php echo $address?>" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Describe the Work Details</label>
                                                                <textarea class="form-control" name="description"
                                                                    id="description" readonly
                                                                    placeholder="Describe the Work Details"><?php echo $description?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12">
                                                            <div class="form-group">

                                                                <button type="submit" name="submit"
                                                                    class="btn btn-md ft-medium text-light rounded theme-bg">Assign
                                                                    Worker</button>
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