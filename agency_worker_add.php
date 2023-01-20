<?php
    include_once("./database/config.php");

    session_start();

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

    if(isset($_POST['submit'])){

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $username = $_POST['username'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $specialization = $_POST['sp$specialization'];

        $date = date("Y-m-d h:i:s");


        $p = $_POST['password'];
        $error = "";
        $cls="";
    
        $name = $_FILES['file']['name'];
        $target_dir = "assets/img/workers/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        if (strlen($p) > 5) {
        
            $query = "SELECT * FROM workers WHERE username = '$username'";
            $query_run = mysqli_query($conn, $query);
            if (!$query_run->num_rows > 0) {

                $query = "SELECT * FROM workers WHERE username = '$username' AND email = '$email'";
                $query_run = mysqli_query($conn, $query);
                if(!$query_run->num_rows > 0){

                    // Check extension
                    if( in_array($imageFileType,$extensions_arr) ){

                        // Upload file
                        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

                            // Convert to base64 
                            $image_base64 = base64_encode(file_get_contents('assets/img/workers/'.$name));
                            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                            // Insert record

                            $query2 = "INSERT INTO workers(agency_id, username, email, `password`, firstname, lastname, contact, gender, birthday, worker_img, `address`, city, zip, specialization)
                            VALUES ('$agency_id','$username', '$email', '$password', '$firstname', '$lastname', '$contact', '$gender', '$birthday', '$name', '$address', '$city', '$zip','$specialization')";
                            $query_run2 = mysqli_query($conn, $query2);
                
                            if ($query_run2) {
                                $cls="success";
                                $error = "Worker Successfully Added.";
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
                else{
                    $cls="danger";
                    $error = "Worker Already Exists";
                }
                
            }else{
                $cls="danger";
                $error = "Username Already Exists";
            }
        }else{
            $cls="danger";
            $error = 'Password has to be minimum of 6 charecters.';
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
                            <li><a href="agency_appointments.php"><i class="lni lni-files mr-2"></i>Manage
                                    Appointments</a></li>
                            <li class="active"><a href="agency_workers.php"><i class="lni lni-users mr-2"></i>Manage Workers</a></li>
                            <?php
                            if($user_read==0){
                                $sql = "SELECT * from messages where agency_id = $agency_id and `agency_read` = 0";
                                $result = mysqli_query($conn, $sql);
                                $row_cnt = $result->num_rows;
                            ?>
                            <li><a href="agency_chat.php"><i
                                        class="lni lni-envelope mr-2"></i>Messages<span
                                        class="count-tag"><?php echo $row_cnt?></span></a>
                            </li>
                            <?php
                            }else{
                            ?>
                            <li><a href="agency_chat.php"><i
                                        class="lni lni-envelope mr-2"></i>Messages</a>
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
                            <h1 class="ft-medium">Manage Workers</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="agency_home.php">Home</a></li>
                                    <li class="breadcrumb-item text-muted"><a href="agency_workers.php">Manage
                                            Workers</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="theme-cl">Add Worker</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="dashboard-widg-bar d-block">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="_dashboard_content bg-white rounded mb-4">

                                <div class="_dashboard_content_body py-3 px-3">
                                    <form class="row" action="" method="POST" enctype='multipart/form-data'
                                        style="margin: 20px;">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="custom-file avater_uploads">
                                                <input type="file" class="custom-file-input" name="file"
                                                    id="customFile">

                                                <label class="custom-file-label" for="customFile"><i
                                                        class="fa fa-user-plus"></i></label>
                                            </div>
                                        </div>

                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                                            <div class="alert alert-<?php echo $cls;?>" style="margin:10px 0">
                                                <?php 
                                                        if (isset($_POST['submit'])){
                                                            echo $error;
                                                        }
                                                    ?>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="firstname"
                                                            id="firstname" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="lastname"
                                                            id="lastname" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Specialization</label>
                                                        <input type="text" class="form-control" name="specialization"
                                                            id="specialization" placeholder="Specialization">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Contact</label>
                                                        <input type="text" class="form-control" name="contact"
                                                            id="contact" placeholder="Contact">
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
                                                            id="birthday" placeholder="Birthday">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" name="email" id="email"
                                                            placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" name="username"
                                                            id="username" placeholder="Username">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Password</label>
                                                        <input type="text" class="form-control" name="password"
                                                            id="password" placeholder="Password">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" name="address"
                                                            id="address" placeholder="Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" name="city" id="city"
                                                            placeholder="City">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Zip</label>
                                                        <input type="text" class="form-control" name="zip" id="zip"
                                                            placeholder="Zip">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-lg-12">
                                                    <div class="form-group">

                                                        <button type="submit" name="submit"
                                                            class="btn btn-md ft-medium text-light rounded theme-bg">&nbsp;&nbsp;Add
                                                            User</button>
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