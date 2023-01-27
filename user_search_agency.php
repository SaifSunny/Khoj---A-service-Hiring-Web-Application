<?php
    include_once("./database/config.php");

    session_start();
    error_reporting(0);

    $username = $_SESSION['username'];

    if (!isset($_SESSION['username'])) {
        header("Location: user_login.php");
    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);

    $_SESSION['image'] = $row['user_img'];
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $row['username'];

    $user_id = $row['user_id'];
    $user_img = $row['user_img'];
    $zip = $row['zip'];

    $keyword = $_POST['search_keyword'];
    $category = $_POST['search_category'];
    $location = $_POST['search_location'];

    $sql1 = "SELECT * FROM category WHERE category_name='$category'";
    $result1 = mysqli_query($conn, $sql1);
    $row1=mysqli_fetch_assoc($result1);
    $category_id = $row1['category_id'];

    
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
                            <li><a href="user_home.php"><i class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                            <li class="active"><a href="user_find_help.php"><i class="lni lni-files mr-2"></i>Find
                                    Help</a>
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
                            <li><a href="user_profile.php"><i class="lni lni-user mr-2"></i>My Profile </a>
                            </li>
                            </li>
                            <li><a href="user_logout.php"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="dashboard-tlbar d-block mb-5">
                    <div class="row">
                        <div class="colxl-12 col-lg-12 col-md-12">
                            <h1 class="ft-medium">Find Agency</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="user_home.php"
                                            class="theme-cl">Dashboard</a> </li>
                                    <li class="breadcrumb-item">Find Agency</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="dashboard-widg-bar d-block">
                    <div class="row">
                        <!-- Item Wrap Start -->
                        <div class="col-lg-8 col-md-12 col-sm-12">

                            <!-- All jobs -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <?php 
												$sql = "SELECT * FROM agency where agency_name like '%$keyword%' And category_id='$category_id' and city = '$location'";
												$result = mysqli_query($conn, $sql);
												if($result){
													while($row=mysqli_fetch_assoc($result)){
													$id=$row['agency_id'];
													$category_id=$row['category_id'];

													$agency_name=$row['agency_name'];
													$contact=$row['contact'];
													$email=$row['email']; 
													$address=$row['address'];
													$city=$row['city'];
													$zip=$row['zip'];
													$agency_img=$row['agency_img'];
													$cost=$row['cost'];

                                                    $sql1 = "SELECT * FROM category where category_id = $category_id";
												    $result1 = mysqli_query($conn, $sql1);
                                                    $row1=mysqli_fetch_assoc($result1);
													$category_name=$row1['category_name'];

											?>
                                    <!-- Single job -->
                                    <div class="job_grid d-block border rounded px-3 pt-3 pb-2" style="height:10rem">
                                        <div class="jb-list01-flex d-flex align-items-start justify-content-start">
                                            <div class="jb-list01-thumb">
                                                <img src="assets/img/agency/<?php echo $agency_img?>" class="img-fluid"
                                                    width="120" alt="" />
                                            </div>

                                            <div class="jb-list01 pl-3">
                                                <div class="jb-list-01-title d-inline" style="font-size:12px">
                                                    <span
                                                        class="mr-2 mb-2 d-inline-flex px-2 py-1 rounded theme-cl theme-bg-light">
                                                        <?php echo $category_name?></span>


                                                </div>
                                                <div class="jb-list-01-title">
                                                    <h5 class="ft-medium mb-1"><a
                                                            href="user_agency_profile.php?agency_id=<?php echo $id?>"><?php echo $agency_name?></a>
                                                    </h5>
                                                </div>

                                                <div class="jb-list-01-info d-block mb-3" style="padding-top:5px">
                                                    <span class="text-muted mr-2"><i
                                                            class="lni lni-map-marker mr-1"></i><?php echo $city?></span>
                                                    <span class="text-muted mr-2"></span>
                                                    <span class="text-muted mr-2"><i
                                                            class="lni lni-check-box mr-1"></i>Contact:
                                                        <?php echo $contact?></span>
                                                    <div class=" d-flex">
                                                    <div>
                                                            <span style="margin-top:10px;margin-left:10px;"
                                                                class="mr-2 mb-2 d-inline-flex px-2 py-1 rounded text-danger bg-light-danger">
                                                                Average Fee: <?php echo $cost?></span>
                                                        </div>
                                                        <div class="star-rating align-items-center d-flex"
                                                            style="padding:0;margin:0;">
                                                            <i class="fas fa-star filled"></i>
                                                        </div>
                                                        <div style="margin-top:10px">
                                                            <p> 4.5 (200)</p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <?php 
													}
												}
											?>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="bg-white rounded">

                                <div class="sidebar_header d-flex align-items-center justify-content-between px-4 py-3 br-bottom">
                                    <h4 class="ft-medium fs-lg mb-0">Search Filter</h4>
                                </div>

                                <!-- Find New Property -->
                                <div class="sidebar-widgets collapse miz_show" id="search_open" data-parent="#search_open">
                                    <form action="user_search_agency.php" method="post">
                                        <div class="search-inner">

                                            <div class="filter-search-box px-4 pt-3 pb-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="search_keyword"
                                                        placeholder="Search by keywords...">
                                                </div>
                                            </div>

                                            <div class="filter_wraps">
                                                    <!-- Job categories Search -->
                                                    <div class="single_search_boxed px-4 pt-0 br-bottom">
                                                        <div class="widget-boxed-header">
                                                            <h4>
                                                                <a href="#categories" class="ft-medium fs-md pb-0"
                                                                    data-toggle="collapse" aria-expanded="true"
                                                                    role="button">Job Categories</a>
                                                            </h4>

                                                        </div>
                                                        <div class="widget-boxed-body collapse show" id="categories"
                                                            data-parent="#categories">
                                                            <div class="side-list no-border">
                                                                <!-- Single Filter Card -->
                                                                <div class="single_filter_card">
                                                                    <div class="card-body p-0">
                                                                        <div class="inner_widget_link">
                                                                            <ul class="no-ul-list filter-list">
                                                                                <?php 
                                                                                    $sql = "SELECT * FROM category";
                                                                                    $result = mysqli_query($conn, $sql);
                                                                                    if($result){
                                                                                        while($row=mysqli_fetch_assoc($result)){
                                                                                        $category_id=$row['category_id'];
                                                                                        $category_name=$row['category_name'];

                                                                                        $sql1 = "SELECT * FROM agency where `category_id` = $category_id";
                                                                                        $result1 = mysqli_query($conn, $sql1);
                                                                                        $row_cnt = $result1->num_rows;

                                                                                ?>
                                                                                <li>
                                                                                    <input id="<?php echo $category_name?>"
                                                                                        class="checkbox-custom"
                                                                                        name="search_category" type="radio" value="<?php echo $category_name?>">
                                                                                    <label for="<?php echo $category_name?>"
                                                                                        class="checkbox-custom-label"><?php echo $category_name?>
                                                                                        (<?php echo $row_cnt?>)</label>
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

                                                    <!-- Job Locations Search -->
                                                    <div class="single_search_boxed px-4 pt-0 br-bottom">
                                                        <div class="widget-boxed-header">
                                                            <h4>
                                                                <a href="#locations" data-toggle="collapse"
                                                                    aria-expanded="false" role="button"
                                                                    class="ft-medium fs-md pb-0 collapsed">Job
                                                                    Locations</a>
                                                            </h4>

                                                        </div>
                                                        <div class="widget-boxed-body collapse" id="locations"
                                                            data-parent="#locations">
                                                            <div class="side-list no-border">
                                                                <!-- Single Filter Card -->
                                                                <div class="single_filter_card">
                                                                    <div class="card-body p-0">
                                                                        <div class="inner_widget_link">
                                                                            <ul class="no-ul-list filter-list">
                                                                                <?php 
                                                                                    $sql = "SELECT distinct city FROM agency";
                                                                                    $result = mysqli_query($conn, $sql);
                                                                                    if($result){
                                                                                        while($row=mysqli_fetch_assoc($result)){
                                                                                        $city=$row['city'];

                                                                                        $sql1 = "SELECT * FROM agency where city = '$city'";
                                                                                        $result1 = mysqli_query($conn, $sql1);
                                                                                        $row_cnt1 = $result1->num_rows;

                                                                                ?>
                                                                                <li>
                                                                                    <input id="<?php echo $city?>"
                                                                                        class="checkbox-custom" 
                                                                                        name="search_location" type="radio" value="<?php echo $city?>">
                                                                                    <label for="<?php echo $city?>"
                                                                                        class="checkbox-custom-label"><?php echo $city?>
                                                                                        (<?php echo $row_cnt1?>)</label>
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

                                            </div>

                                            <div class="form-group filter_button pt-2 pb-4 px-4">
                                                <button type="submit"
                                                    class="btn btn-md theme-bg text-light rounded full-width">
                                                    Show Results</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- Sidebar End -->

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