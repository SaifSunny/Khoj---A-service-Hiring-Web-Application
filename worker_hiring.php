<?php
    include_once("./database/config.php");
    error_reporting(0);

    session_start();

    $username = $_SESSION['workername'];

    if (!isset($_SESSION['workername'])) {
        header("Location: worker_login.php");
    }

    $sql = "SELECT * FROM workers WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);

    $_SESSION['image'] = $row['worker_img'];
    $_SESSION['worker_id'] = $row['worker_id'];
    $_SESSION['workername'] = $row['username'];

    $worker_id = $row['worker_id'];
    $worker_img = $row['worker_img'];
    $zip = $row['zip'];

    $sql22 = "SELECT * FROM w_messages WHERE worker_id='$worker_id'";
    $result22 = mysqli_query($conn, $sql22);
    $row22=mysqli_fetch_assoc($result22);

    $user_read = $row22['worker_read'];
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
                            <li><a href="worker_home.php"><i class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                            <li><a href="worker_appointment.php"><i
                                        class="lni lni-briefcase mr-2"></i>Assigneed
                                    Jobs</a></li>
                            <li  class="active"><a href="worker_hiring.php"><i class="lni lni-bookmark mr-2"></i>Job History</a></li>
                            <?php
                            if($user_read==0){
                                $sql = "SELECT * from w_messages where worker_id = $worker_id and `worker_read` = 0";
                                $result = mysqli_query($conn, $sql);
                                $row_cnt = $result->num_rows;
                            ?>
                            <li><a href="worker_chat.php"><i class="lni lni-envelope mr-2"></i>Messages<span
                                        class="count-tag"><?php echo $row_cnt?></span></a>
                            </li>
                            <?php
                            }else{
                            ?>
                            <li><a href="worker_chat.php"><i class="lni lni-envelope mr-2"></i>Messages</a>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <ul data-submenu-title="My Accounts">
                            <li><a href="worker_profile.php"><i class="lni lni-user mr-2"></i>My Profile </a>
                            </li>
                            </li>
                            <li><a href="logout.php"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="dashboard-tlbar d-block mb-5">
                    <div class="row">
                        <div class="colxl-12 col-lg-12 col-md-12">
                            <h1 class="ft-medium">Job History</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item muted"><a href="#" class="theme-cl">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="theme-cl">Job History</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>


                <div class="dashboard-widg-bar d-block">
                    <div class="row">
                        <div class="col-lg-12 col-md-12  bg-white">
                            <div class="table-responsive bg-white">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">User Information</th>
                                            <th scope="col">Work Title</th>
                                            <th scope="col">Appointment Date</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                $sql0 = "SELECT * FROM work_assign where worker_id = '$worker_id' and status=1";
                                                $result0 = mysqli_query($conn, $sql0);
                                                if($result0){
                                                    while($row0=mysqli_fetch_assoc($result0)){
                                                        $id=$row0['appointment_id'];
                                                        $status=$row0['status'];
    
                                                        $sql = "SELECT * FROM appointments where appointment_id = '$id'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row=mysqli_fetch_assoc($result);
                                                        $user_id=$row['user_id'];

                                                    $title=$row['title'];
                                                    $appointment_datetime=$row['appointment_datetime'];
                                                    $cost=$row['cost'];
                                                    $contact=$row['contact'];
                                                    $aa_address=$row['address'];
                                                    $status=$row['status'];


                                                    $sql1 = "SELECT * FROM users where user_id = '$user_id'";
                                                    $result1 = mysqli_query($conn, $sql1);
                                                    $row1=mysqli_fetch_assoc($result1);
                                                    $user_name=$row1['firstname']." ".$row1['lastname'];
                                                    $user_img=$row1['user_img'];
                                                    $ag_city=$row1['city'];

                                            ?>
                                        <tr>
                                            <td>
                                                <div class="cats-box rounded bg-white d-flex align-items-center">
                                                    <div class="text-center"><img
                                                            src="assets/img/users/<?php echo $user_img?>"
                                                            class="img-fluid" width="55" alt=""></div>
                                                    <div class="cats-box-caption px-2">
                                                        <h4 class="fs-md mb-0 ft-medium" style="padding-left:10px;">
                                                            <?php echo $user_name?></h4>
                                                        <div class="d-block mb-2 position-relative"
                                                            style="padding-left:10px;">
                                                            <span class="text-muted medium"><i
                                                                    class="lni lni-map-marker mr-1"></i><?php echo $ag_city?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo $title?></td>
                                            <td><?php echo date("d F Y h:i A", strtotime($appointment_datetime))?></td>
                                            <td>Tk. <?php echo $cost?></td>
                                            <td><?php echo $contact?></td>
                                            <td>
                                                <?php
                                                        if($status==3){
                                                    ?>
                                                <a href=""
                                                    class="p-2 text-warning bg-light-warning d-inline-flex align-items-center justify-content-center ml-1">Job
                                                    Completed</a>
                                                <?php
                                                        }
                                                    ?>

                                            </td>
                                        </tr>
                                        <?php 
                                                    }
                                                }
                                            ?>
                                    </tbody>
                                </table>
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