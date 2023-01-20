<?php
    include_once("./database/config.php");

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
                            <li><a href="worker_home.php"><i
                                        class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                            <li><a href="worker_appointment.php"><i class="lni lni-briefcase mr-2"></i>Assigneed Jobs</a></li>
                            <li><a href="worker_hiring.php"><i class="lni lni-bookmark mr-2"></i>Job History</a></li>
                        </ul>
                        <ul data-submenu-title="My Accounts">
                            <li class="active"><a href="worker_profile.php"><i class="lni lni-user mr-2"></i>My Profile </a>
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
                            <h1 class="ft-medium">Hello, <?php echo $username?></h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="theme-cl">Worker Dashboard</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="dashboard-widg-bar d-block">
                <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="dash-widgets py-5 px-4 bg-success rounded">
                                <?php
                                    $sql = "SELECT * from appointments where user_id = $user_id and `status` = 0";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                                <h2 class="ft-medium mb-1 fs-xl text-light"><?php echo $row_cnt?></h2>
                                <p class="p-0 m-0 text-light fs-md">Upcomming Jobs</p>
                                <i class="lni lni-empty-file"></i>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="dash-widgets py-5 px-4 bg-success rounded">
                                <?php
                                    $sql = "SELECT Distinct agency_id from appointments where user_id =$user_id and `status` = 3";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                                <h2 class="ft-medium mb-1 fs-xl text-light"><?php echo $row_cnt?></h2>
                                <p class="p-0 m-0 text-light fs-md">Jobs Completed</p>
                                <i class="lni lni-users"></i>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="dash-widgets py-5 px-4 bg-success rounded">
                            <?php
                                    $sql = "SELECT * from work_assign where worker_id=$worker_id";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                                <h2 class="ft-medium mb-1 fs-xl text-light"><?php echo $row_cnt?></h2>
                                <p class="p-0 m-0 text-light fs-md">Assigned Jobs</p>
                                <i class="lni lni-heart"></i>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="dashboard-gravity-list with-icons">
                                <h4 class="mb-0 ft-medium">Upcoming Appointments</h4>
                                <ul>
                                    <li>

                                    </li>

                                </ul>
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