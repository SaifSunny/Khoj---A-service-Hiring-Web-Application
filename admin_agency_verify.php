<?php
include_once("./database/config.php");

session_start();

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
                <i class="fas fa-bars mr-2"></i>Dashboard Navigation
            </a>
            <div class="collapse" id="MobNav">
                <div class="dashboard-nav">
                    <div class="dashboard-inner">
                        <a class="nav-brand" href="#">
                            <img src="assets/img/logo.png" class="logo" alt="" style="margin: 20px 40px;" />
                        </a>
                        <ul data-submenu-title="Main Navigation">
                            <li><a href="admin_home.php"><i class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                            <li><a href="admin_category.php"><i class="lni lni-list mr-2"></i>Manage Categories</a></li>
                            <li><a href="admin_users.php"><i class="lni lni-users mr-2"></i>Manage Users</a></li>
                            <li><a href="admin_agencies.php"><i class="lni lni-apartment mr-2"></i>Manage Agencies</a></li>
                            <li class="active"><a href="admin_agency_verify.php"><i class="lni lni-circle-plus mr-2"></i>Verify Agency</a></li>
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
                        <div class="colxl-10 col-lg-10 col-md-8">
                            <h1 class="ft-medium">Verify Agencies</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="admin_home.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="theme-cl">Verify Agencies</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="dashboard-widg-bar d-block">
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="mb-4 tbl-lg rounded overflow-hidden">
                                <div class="table-responsive bg-white">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                            <th scope="col">Agency Information</th>
                                                <th scope="col">Established</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Average Hiring Cost</th>
                                                <th scope="col">Licence</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
												$sql = "SELECT * FROM agency where `status` = 0";
												$result = mysqli_query($conn, $sql);
												if($result){
													while($row=mysqli_fetch_assoc($result)){
                                                        $id=$row['agency_id'];
                                                        $category_id=$row['category_id'];
    
                                                        $name=$row['agency_name'];
                                                        $contact=$row['contact'];
                                                        $email=$row['email'];
                                                        $address=$row['address']." ".$row['city']."-".$row['zip'];
                                                        $agency_img=$row['agency_img'];
                                                        $cost=$row['cost'];
                                                        $established=$row['established'];
    
                                                        $sql1 = "SELECT * FROM category where `category_id` = $category_id";
                                                        $result1 = mysqli_query($conn, $sql1);
                                                        $row1=mysqli_fetch_assoc($result1);
                                                        $category_name=$row1['category_name'];
											?>
                                            <tr>
                                            <td>
                                                    <div class="cats-box rounded bg-white d-flex align-items-center">
                                                        <div class="text-center"><img
                                                                src="assets/img/agency/<?php echo $agency_img?>"
                                                                class="img-fluid" width="55" alt=""></div>
                                                        <div class="cats-box-caption px-2">
                                                            <h4 class="fs-md mb-0 ft-medium" style="padding-left:10px;">
                                                                <?php echo $name?></h4>
                                                            <div class="d-block mb-2 position-relative"
                                                                style="padding-left:10px;">
                                                                <span class="text-muted medium"><?php echo $category_name?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?php echo $established?></td>
                                                <td><?php echo $address?></td>
                                                <td><?php echo $contact?></td>
                                                <td><?php echo $email?></td>
                                                <td><?php echo $cost?></td>
                                                <td>
                                                    <div class="dash-action d-flex">
                                                    <a href="admin_agency_licence.php?id=<?php echo $id?>"
                                                            class="p-2 circle text-success bg-light-success d-inline-flex align-items-center justify-content-center ml-1"><i class="lni lni-eye"></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dash-action d-flex">
                                                    <a href="admin_agency_verification.php?id=<?php echo $id?>"
                                                            class="p-2 circle text-success bg-light-success d-inline-flex align-items-center justify-content-center ml-1"><i class="lni lni-checkmark-circle"></i></a>
                                                        <a href="admin_agency_delete.php?id=<?php echo $id?>"
                                                            class="p-2 circle text-danger bg-light-danger d-inline-flex align-items-center justify-content-center ml-1"><i
                                                                class="lni lni-trash-can"></i></a>
                                                    </div>
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