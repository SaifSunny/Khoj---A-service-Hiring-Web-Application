<?php
include_once("./database/config.php");

session_start();
error_reporting(0);

$username = $_SESSION['adminname'];

if (!isset($_SESSION['adminname'])) {
    header("Location: admin_login.php");
}

$sql = "SELECT * FROM `admin` WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

$img=$row['admin_img'];
$admin_id=$row['admin_id'];

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
                <i class="fas fa-bars mr-2"></i>Navigation
            </a>
            <div class="collapse" id="MobNav">
                <div class="dashboard-nav">
                    <div class="dashboard-inner">
                        <a class="nav-brand" href="#">
                            <img src="assets/img/logo.png" class="logo" alt="" style="margin: 20px 40px;" />
                        </a>
                        <ul data-submenu-title="Main Navigation">
                            <li class="active"><a href="admin_home.php"><i
                                        class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                            <li><a href="admin_category.php"><i class="lni lni-list mr-2"></i>Manage Categories</a></li>
                            <li><a href="admin_users.php"><i class="lni lni-users mr-2"></i>Manage Users</a></li>
                            <li><a href="admin_agencies.php"><i class="lni lni-apartment mr-2"></i>Manage Agencies</a>
                            </li>
                            <li><a href="admin_agency_verify.php"><i class="lni lni-circle-plus mr-2"></i>Verify
                                    Agency</a></li>
                            </li>
                        </ul>
                        <ul data-submenu-title="My Accounts">
                            <li><a href="admin_profile.php"><i class="lni lni-user mr-2"></i>My Profile </a></li>
                            <li><a href="logout.php"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Navigation -->

            <div class="dashboard-content">
                <div class="dashboard-tlbar d-block mb-5">
                    <div class="row">
                        <div class="colxl-12 col-lg-12 col-md-12">
                            <h1 class="ft-medium">Hello, Mushfika</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="theme-cl">Dashboard</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="dashboard-widg-bar d-block">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="dash-widgets py-5 px-4 bg-success rounded">
                                <?php
                                    $sql = "SELECT * from category";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                                <h2 class="ft-medium mb-1 fs-xl text-light"><?php echo $row_cnt?></h2>
                                <p class="p-0 m-0 text-light fs-md">Categories</p>
                                <i class="lni lni-empty-file"></i>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="dash-widgets py-5 px-4 bg-success rounded">
                                <?php
                                    $sql = "SELECT * from users";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                                <h2 class="ft-medium mb-1 fs-xl text-light"><?php echo $row_cnt?></h2>
                                <p class="p-0 m-0 text-light fs-md">Users</p>
                                <i class="lni lni-users"></i>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="dash-widgets py-5 px-4 bg-success rounded">
                                <?php
                                    $sql = "SELECT * from agency";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                                <h2 class="ft-medium mb-1 fs-xl text-light"><?php echo $row_cnt?></h2>
                                <p class="p-0 m-0 text-light fs-md">Agencies</p>
                                <i class="lni lni-bar-chart"></i>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="dash-widgets py-5 px-4 bg-success rounded">
                            <?php
                                    $sql = "SELECT * from appointments where `status` = '3'";
                                    $result = mysqli_query($conn, $sql);
                                    $row_cnt = $result->num_rows;
                                ?>
                                <h2 class="ft-medium mb-1 fs-xl text-light"><?php echo $row_cnt?></h2>
                                <p class="p-0 m-0 text-light fs-md">Hirings</p>
                                <i class="lni lni-heart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-8 col-md-12">
                            <div class="dashboard-gravity-list with-icons">
                                <h4 class="mb-0 ft-medium">Verify Agencies</h4>
                                
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="dashboard-gravity-list invoices with-icons">
                                <h4 class="mb-0 ft-medium">Recent Login</h4>
                                <ul>
                                    <?php 
                                        $sql = "SELECT DISTINCT `name`, `role`, `image` FROM latest_users ORDER BY id DESC LIMIT 8;";
                                        $result = mysqli_query($conn, $sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                            
                                                $name=$row['name'];
                                                $image=$row['image'];
                                                $role=$row['role'];

                                                if($role=="User"){
                                                    $dir="users";
                                                }elseif($role=="Agency"){
                                                    $dir="agency";
                                                }elseif($role=="Worker"){
                                                    $dir="workers";
                                                }else{
                                                    $dir="admin";
                                                }
                                    ?>
                                    <li>
                                        
                                        <i class="dash-icon-box text-warning bg-light-warning"><img src="assets/img/<?php echo $dir."/".$image?>" style="width:40px;border-radius: 50%;"
                                            alt="profile"></i>
                                        <strong class="ft-medium text-dark"><?php echo $name?></strong>
                                        <ul>
                                            <li>Role: <?php echo $role?></li>
                                        </ul>
                                    </li>
                                    <?php
                                            }
                                        }
                                    ?>
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