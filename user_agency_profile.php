<?php
    include_once("./database/config.php");

    session_start();

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


    $sql = "SELECT * FROM agency";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);

        $agency_id=$row['agency_id'];
        $category_id=$row['category_id'];

        $agency_name=$row['agency_name'];
        $contact=$row['contact'];
        $email=$row['email'];
        $address=$row['address'];
        $city=$row['city'];
        $zip=$row['zip'];
        $agency_img=$row['agency_img'];
        $cost=$row['cost'];
        $established=$row['established'];
        $about=$row['about'];

        $sql1 = "SELECT * FROM category where category_id = $category_id";
        $result1 = mysqli_query($conn, $sql1);
        $row1=mysqli_fetch_assoc($result1);
        $category_name=$row1['category_name'];


        
if(isset($_POST['submit'])){

    $hire_from = $_POST['start_date']." ".$_POST['start_time'];
    $hire_to = $_POST['end_date']." ".$_POST['end_time'];
    $message = $_POST['message'];
    $contact = $_POST['contact'];
    $baby_id = $_POST['baby_name'];

    $timestamp1 = strtotime($hire_from);
    $timestamp2 = strtotime($hire_to);
    $hour = abs($timestamp2 - $timestamp1)/(60*60);
    $total_amount = $hour*$rate;
  
    $query = "SELECT * FROM hire_babysitter WHERE user_id = '$user_id' AND baby_id = '$baby_id' AND `hire_from` = '$hire_from' AND `hire_to` = '$hire_to'";
    $query_run = mysqli_query($conn, $query);
    if(!$query_run->num_rows > 0){

            $query2 = "INSERT INTO hire_babysitter(`user_id`, babysitter_id, baby_id, user_img, babysitter_img, baby_img, `user_name`, babysitter_name, baby_name, `hire_from`, `hire_to`, `message`, `contact`,total_amount)
            VALUES ('$user_id', '$sitter_id', '$baby_id','$user_img', '$sitter_img',
            (SELECT `baby_img` FROM baby WHERE baby_id='$baby_id'), '$username', '$sitter_name',
            (SELECT `baby_name` FROM baby WHERE baby_id='$baby_id'), '$hire_from', '$hire_to','$message','$contact',$total_amount)";
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
        $cls="danger";
        $error ="Meeting Already Placed.";
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
                            <li class=""><a href="user_chat.php"><i class="lni lni-envelope mr-2"></i>Messages<span
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
                    <div class="row align-items-start justify-content-between" style="padding: 0 40px">

                        <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                            <div class="d-block border rounded mfliud-bot mb-4 bg-white">
                                <div class="cdt_author px-2 pt-5 pb-4">
                                    <div class="dash_auth_thumb rounded p-1 border d-inline-flex mx-auto mb-3">
                                        <img src="assets/img/agency/<?php echo $agency_img?>" class="img-fluid"
                                            width="100" alt="" />
                                    </div>
                                    <div class="dash_caption mb-4">
                                        <h4 class="fs-lg ft-medium mb-0 lh-1"><?php echo $agency_name?></h4>
                                        <div class=" d-flex justify-content-center">
                                            <div class="star-rating align-items-center d-flex"
                                                style="padding:0;margin:0;">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div style="margin-top:10px">
                                                <p> 4 (200)</p>
                                            </div>
                                        </div>
                                        <span class="text-muted smalls">Location: <?php echo $city?></span> <br>
                                        <span class="text-muted mr-2">Contact:
                                            <?php echo $contact?></span> <br>
                                        <span class="text-muted mr-2">
                                            Email:
                                            <?php echo $email?></span>

                                    </div>
                                    <div class="jb-list-01-title d-inline" style="font-size:12px">
                                        <span class="mr-2 mb-2 d-inline-flex px-2 py-1 rounded theme-cl theme-bg-light">
                                            <?php echo $category_name?></span><br>

                                        <span
                                            class="mr-2 mb-2 d-inline-flex px-2 py-1 rounded text-danger bg-light-danger">
                                            Average Hiring Cost: <?php echo $cost?></span>
                                    </div>
                                </div>

                                <div class="cdt_caps" style="padding: 0 20px;">

                                    <div
                                        class="job_grid_footer pb-3 px-3 d-flex align-items-center justify-content-between">
                                        <div class="df-1 text-muted">Established:
                                            <?php echo $established?></div>

                                    </div>
                                    <div
                                        class="job_grid_footer pb-3 px-3 d-flex align-items-center justify-content-between">
                                        <div class="df-1 text-muted">Full Address:
                                            <?php echo $address." ".$city."-".$zip?></div>

                                    </div>
                                    <div
                                        class="job_grid_footer pb-3 px-3 d-flex align-items-center justify-content-between">
                                        <div class="df-1 text-muted">Contact: <?php echo $contact?></div>

                                    </div>
                                    <div
                                        class="job_grid_footer pb-3 px-3 d-flex align-items-center justify-content-between">
                                        <div class="df-1 text-muted">Email: <?php echo $email?></div>

                                    </div>

                                </div>

                                <div class="cdt_caps py-3 px-5">
                                    <a href="user_agency_hire.php?user_id=<?php echo $user_id?>&agency_id=<?php echo $agency_id?>" class="btn btn-md theme-bg text-light rounded full-width">Hire Now</a>
                                </div>
                                <div class="cdt_caps px-5" style=" padding-bottom:40px">
                                    <a href="user_create_chat.php?agency_id=<?php echo $agency_id?>&user_id=<?php echo $user_id?>" class="btn btn-md bg-warning text-light rounded full-width">Send
                                        Message</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-8 col-xl-8">

                            <!-- row -->
                            <div class="row align-items-start">

                                <!-- About -->
                                <div class="abt-cdt d-block full-width mb-4">
                                    <h4 class="ft-medium mb-1 fs-md" style="padding-bottom:20px;">About The Agency</h4>
                                    <p><?php echo $about?></p>
                                    <h4 class="ft-medium mb-1 fs-md" style="padding-bottom:20px;">Jobs Completed:</h4>
                                </div>
                                <div class="abt-cdt d-block full-width mb-4">
                                    <h4 class="ft-medium mb-1 fs-md" style="padding-bottom:20px;">Total Reviews:</h4>
                                    <div class=" d-flex justify-content-left">
                                        <div class="star-rating align-items-left d-flex"
                                            style="padding-top:7px;margin:0;">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                        </div>
                                        <p>5 Reviews</p>
                                    </div>
                                    <div class=" d-flex justify-content-left">
                                        <div class="star-rating align-items-left d-flex"
                                            style="padding-top:7px;margin:0;">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;&nbsp;&nbsp;
                                        </div>
                                        <p>5 Reviews</p>
                                    </div>
                                    <div class=" d-flex justify-content-left">
                                        <div class="star-rating align-items-left d-flex"
                                            style="padding-top:7px;margin:0;">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                        </div>
                                        <p>5 Reviews</p>
                                    </div>
                                    <div class=" d-flex justify-content-left">
                                        <div class="star-rating align-items-left d-flex"
                                            style="padding-top:7px;margin:0;">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                        </div>
                                        <p>5 Reviews</p>
                                    </div>
                                    <div class=" d-flex justify-content-left">
                                        <div class="star-rating align-items-left d-flex"
                                            style="padding-top:7px;margin:0;">
                                            <i class="fas fa-star filled"></i>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                        </div>
                                        <p>5 Reviews</p>
                                    </div>
                                </div>

                                <!-- Comments -->
                                <div class="abt-cdt d-block full-width mb-4">
                                    <h4 class="ft-medium mb-1 fs-md" style="padding-bottom:20px;">Customer Reviews</h4>
                                    <div class="jb-list01-flex d-flex align-items-start justify-content-start">
                                        <div class="jb-list01-thumb">
                                            <img src="assets/img/agency/<?php echo $agency_img?>" class="img-fluid"
                                                width="60" alt="" />
                                        </div>

                                        <div class="jb-list01 pl-3">

                                            <div class="jb-list-01-title">

                                                <h5 class="ft-medium mb-1"><?php echo $agency_name?></h5>
                                                <div class=" d-flex" style="margin: 5px 0;">
                                                    <div class="star-rating align-items-center d-flex"
                                                        style="padding:0;margin:0;">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="jb-list-01-info d-block mb-3" style="padding-top:5px">
                                                <span class="text-muted mr-2"><?php echo $city?></span>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- row -->

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