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
                            <li><a href="user_find_help.php"><i class="lni lni-files mr-2"></i>Find
                                    Help</a>
                            </li>
                            <?php
                            if($user_read==0){
                                $sql = "SELECT * from messages where user_id = $user_id and `user_read` = 0";
                                $result = mysqli_query($conn, $sql);
                                $row_cnt = $result->num_rows;
                            ?>
                            <li><a href="user_chat.php"><i class="lni lni-envelope mr-2"></i>Messages<span
                                        class="count-tag"><?php echo $row_cnt?></span></a>
                            </li>
                            <?php
                            }else{
                            ?>
                            <li><a href="user_chat.php"><i class="lni lni-envelope mr-2"></i>Messages</a>
                            </li>
                            <?php
                            }
                            ?>
                            <li class="active"><a href="user_appointment.php"><i class="lni lni-bookmark mr-2"></i>My
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
                            <h1 class="ft-medium">Chats</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="user_home.php"
                                            class="theme-cl">Dashboard</a> </li>
                                    <li class="breadcrumb-item">Chats</li>
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
                                                <th scope="col">Work Title</th>
                                                <th scope="col">Appointment Date</th>
                                                <th scope="col">Payment</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql = "SELECT * FROM appointments where user_id = '$user_id'";
                                                $result = mysqli_query($conn, $sql);
                                                if($result){
                                                    while($row=mysqli_fetch_assoc($result)){
                                                    $id=$row['appointment_id'];
                                                    $agency_id=$row['agency_id'];

                                                    $title=$row['title'];
                                                    $appointment_datetime=$row['appointment_datetime'];
                                                    $cost=$row['cost'];
                                                    $contact=$row['contact'];
                                                    $address=$row['address'];
                                                    $status=$row['status'];

                                                    $sql1 = "SELECT * FROM agency where agency_id = '$agency_id'";
                                                    $result1 = mysqli_query($conn, $sql1);
                                                    $row1=mysqli_fetch_assoc($result1);
                                                    $agency_name=$row1['agency_name'];
                                                    $agency_img=$row1['agency_img'];
                                                    $ag_city=$row1['city'];

                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="cats-box rounded bg-white d-flex align-items-center">
                                                        <div class="text-center"><img
                                                                src="assets/img/agency/<?php echo $agency_img?>"
                                                                class="img-fluid" width="55" alt=""></div>
                                                        <div class="cats-box-caption px-2">
                                                            <h4 class="fs-md mb-0 ft-medium" style="padding-left:10px;">
                                                                <?php echo $agency_name?></h4>
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
                                                        if($status==0){
                                                    ?>
                                                    <a href=""
                                                        class="p-2 text-danger bg-light-danger d-inline-flex align-items-center justify-content-center ml-1">Appointment
                                                        Placed</a>
                                                    <?php
                                                        }elseif($status==1){
                                                    ?>
                                                    <a href=""
                                                        class="p-2 text-success bg-light-success d-inline-flex align-items-center justify-content-center ml-1">
                                                        Accepted</a>
                                                    <?php
                                                        }elseif($status==2){
                                                    ?>
                                                    <a href=""
                                                        class="p-2 text-warning bg-light-warning d-inline-flex align-items-center justify-content-center ml-1">Worker Assigned</a>
                                                    <?php
                                                        }elseif($status==4){
                                                    ?>
                                                     <a href=""
                                                        class="p-2 text-warning bg-light-warning d-inline-flex align-items-center justify-content-center ml-1">Cancled</a>
                                                    <?php
                                                        }
                                                    ?>

                                                </td>
                                                <td>
                                                    <div class="dash-action">
                                                        <a href="user_appointment_cancel.php?id=<?php echo $id?>"
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