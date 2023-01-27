<?php
    include_once("./database/config.php");
    date_default_timezone_set('Asia/Dhaka');
    error_reporting(0);

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

    if(isset($_POST['submit'])){

        $category_name = $_POST['category_name'];
        $description = $_POST['description'];
        $date = date("Y-m-d h:i:s");

        $error = "";
        $cls="";
    
        $name = $_FILES['file']['name'];
        $target_dir = "assets/img/category/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        
            $query = "SELECT * FROM category WHERE category_name = '$category_name'";
            $query_run = mysqli_query($conn, $query);
            if (!$query_run->num_rows > 0) {

                    // Check extension
                    if( in_array($imageFileType,$extensions_arr) ){

                        // Upload file
                        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){

                            // Convert to base64 
                            $image_base64 = base64_encode(file_get_contents('assets/img/category/'.$name));
                            $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                            // Insert record

                            $query2 = "INSERT INTO category(category_img,category_name,`creation_date`, `description`)
                            VALUES ('$name', '$category_name', '$date', '$description')";
                            $query_run2 = mysqli_query($conn, $query2);
                
                            if ($query_run2) {
                                $cls="success";
                                $error = "Category Successfully Added.";
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

                
            }else{
                $cls="danger";
                $error = "Category Already Exists";
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
                            <li class="active"><a href="admin_category.php"><i class="lni lni-list mr-2"></i>Manage Categories</a></li>
                            <li><a href="admin_users.php"><i class="lni lni-users mr-2"></i>Manage Users</a></li>
                            <li><a href="admin_agencies.php"><i class="lni lni-apartment mr-2"></i>Manage Agencies</a></li>
                            <li><a href="admin_agency_verify.php"><i class="lni lni-circle-plus mr-2"></i>Verify Agency</a></li>
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
                            <h1 class="ft-medium">Add Category</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item text-muted"><a href="admin_home.php">Home</a></li>
                                    <li class="breadcrumb-item text-muted"><a href="admin_category.php">Manage Categories</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#" class="theme-cl">Add Category</a></li>
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
                                    <form class="row" action="" method="POST" enctype='multipart/form-data'>
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                            <div class="custom-file avater_uploads">
                                                <input type="file" class="custom-file-input" name="file"
                                                    id="customFile">

                                                <label class="custom-file-label" for="customFile"><i
                                                        class="fa fa-plus"></i></label>
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

                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Category Name</label>
                                                        <input type="text" class="form-control" name="category_name"
                                                            id="category_name" placeholder="Category Name">
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group" style="padding:10px">
                                                        <label>Category Description</label>

                                                        <textarea name="description" class="form-control"
                                                            id="description" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-lg-12">
                                                    <div class="form-group">

                                                        <button type="submit" name="submit"
                                                            class="btn btn-md ft-medium text-light rounded theme-bg">&nbsp;&nbsp;Add
                                                            Category</button>
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