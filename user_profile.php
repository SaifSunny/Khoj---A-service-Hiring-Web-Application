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

if (isset($_POST['submit_img'])) {

    $error = "";
    $cls="";
 
    $name = $_FILES['file']['name'];
    $target_dir = "assets/img/users/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){

        // Upload file
        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

            // Convert to base64 
            $image_base64 = base64_encode(file_get_contents('assets/img/users/'.$name));
            $image = 'data:img/'.$imageFileType.';base64,'.$image_base64;

            // Update Record
            $query2 = "UPDATE `users` SET `user_img`='$name' WHERE username='$username'";
            $query_run2 = mysqli_query($conn, $query2);

            $query3 = "UPDATE `latest_users` SET `image`='$name' WHERE `name`='$username'";
            $query_run3 = mysqli_query($conn, $query3);

            if ($query_run2 && $query_run3) {
                echo "<script> alert('Profile Image Successfully Updated.');
                window.location.href='user_profile.php';</script>";
            } 
            else {
                $cls="danger";
                $error = mysqli_error($conn);
            }

        }else{
            $cls="danger";
            $error = 'Unknown Error Occurred.';
        }
    }else{
        $cls="danger";
        $error = 'Invalid File Type';
    }   
}

if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender=$_POST['gender'];
    $birthday=$_POST['birthday'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zip=$_POST['zip'];

    $error = "";
    $cls="";

        // Update Record
        $query2 = "UPDATE `users` SET firstname='$firstname',lastname='$lastname',
        birthday='$birthday', gender='$gender', contact='$contact',
        `address`='$address', city='$city', zip='$zip' WHERE username='$username'";
        $query_run2 = mysqli_query($conn, $query2);
        
        if ($query_run2) {
            $cls="success";
            $error = "Profile Successfully Updated.";
        } 
        else {
            $cls="danger";
            $error = mysqli_error($conn);
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
                            <li><a href="user_find_help.php"><i class="lni lni-files mr-2"></i>Find Help</a>
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
                            <li class="active"><a href="user_profile.php"><i class="lni lni-user mr-2"></i>My Profile </a>
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
                            <h1 class="ft-medium">My Profile</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="admin_home.php">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="theme-cl">My Profile</a></li>
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
                                        <div class="col-md-2">
                                            <form action="" method="POST" enctype='multipart/form-data'
                                                style="margin: 20px;">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div style="width: 200px; height: 200px;">
                                                        <img src="./assets/img/users/<?php echo $image?>" width="100%"
                                                            height="100%" style="text-align:center;">
                                                        <input type="file" name="file" id="file" style="margin: 20px 0;">
                                                            <button type=" submit" name="submit_img"
                                                            class="btn btn-md ft-medium text-light rounded theme-bg">Update
                                                        Image</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-10" style="padding-left:40px;">
                                            <form action="" method="POST" enctype='multipart/form-data'
                                                style="margin: 0 40px;">

                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                    <div class="alert alert-<?php echo $cls;?>" style="margin:10px 0">
                                                        <?php 
                                                        if (isset($_POST['submit'])||isset($_POST['submit_img'])){
                                                            echo $error;
                                                        }
                                                    ?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>First Name</label>
                                                                <input type="text" class="form-control" name="firstname"
                                                                    id="firstname" placeholder="First Name" value="<?php echo $firstname?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Last Name</label>
                                                                <input type="text" class="form-control" name="lastname"
                                                                    id="lastname" placeholder="Last Name" value="<?php echo $lastname?>">
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
                                                                <label>Gender</label>
                                                                <select class="form-control" name="gender" id="gender"
                                                                    placeholder="Gender" required>
                                                                    <option>-- Select Gender --</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="padding:10px">
                                                                <label>Birthday</label>
                                                                <input type="date" class="form-control" name="birthday"
                                                                    id="birthday" placeholder="Birthday" value="<?php echo $birthday?>">
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

                                                        <div class="col-xl-12 col-lg-12">
                                                            <div class="form-group">

                                                                <button type="submit" name="submit"
                                                                    class="btn btn-md ft-medium text-light rounded theme-bg">Update
                                                                    Profile</button>
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