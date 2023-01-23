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

    
    $room_id=$_GET['room_id'];

    if(isset($_POST['submit'])){

        $link = $_POST['link'];
            // Insert record
    
            $query2 = "UPDATE chat_room SET link = '$link' WHERE room_id = '$room_id'";
            $query_run2 = mysqli_query($conn, $query2);
                
            if ($query_run2) {
                header("Location: user_messages.php?room_id='$room_id'");
            } 
            else {
                $cls="danger";
                $error = mysqli_error($conn);
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
                            <li><a href="worker_home.php"><i
                                        class="lni lni-dashboard mr-2"></i>Dashboard</a></li>
                            <li><a href="worker_appointment.php"><i class="lni lni-briefcase mr-2"></i>Assigneed
                                    Jobs</a></li>
                            <li><a href="worker_hiring.php"><i class="lni lni-bookmark mr-2"></i>Job History</a></li>
                            <?php
                            if($user_read==0){
                                $sql = "SELECT * from w_messages where worker_id = $worker_id and `worker_read` = 0";
                                $result = mysqli_query($conn, $sql);
                                $row_cnt = $result->num_rows;
                            ?>
                            <li  class="active"><a href="worker_chat.php"><i
                                        class="lni lni-envelope mr-2"></i>Messages<span
                                        class="count-tag"><?php echo $row_cnt?></span></a>
                            </li>
                            <?php
                            }else{
                            ?>
                            <li  class="active"><a href="worker_chat.php"><i class="lni lni-envelope mr-2"></i>Messages</a>
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
                            <h1 class="ft-medium">Chats</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="worker_home.php"
                                            class="theme-cl">Dashboard</a> </li>
                                    <li class="breadcrumb-item">Chats</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="dashboard-widg-bar d-block">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="_dashboard_content bg-white rounded mb-4">

                                <div class="_dashboard_content_body">
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
                                                                <label>Google Meet Link</label>
                                                                <input type="text" class="form-control" name="link"
                                                                    id="link" placeholder="Google Meet Link" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12 col-lg-12">
                                                            <div class="form-group">
                                                                <button type="submit" name="submit"
                                                                    class="btn btn-md ft-medium text-light rounded theme-bg">Set
                                                                    Meeting Link</button>
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