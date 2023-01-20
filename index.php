<?php
    include_once("./database/config.php");
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Khoj - Service Hiring App</title>

    <!-- Custom CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <!-- Main -->

    <div id="main-wrapper">

        <!-- Start Navigation -->
        <div class="header header-light head-shadow position-relative" style="padding:7px 0px;">
            <div class="container">
                <nav id="navigation" class="navigation navigation-landscape">
                    <div class="nav-header">
                        <a class="nav-brand" href="#">
                            <img src="assets/img/logo.png" class="logo" alt="" />
                        </a>
                        <div class="nav-toggle"></div>
                        <div class="mobile_nav">
                            <ul>
                                <li>

                                    <div class="dropdown">
                                        <a class="dropdown-toggle ft-medium" href="#" role="button"
                                            data-toggle="dropdown" aria-expanded="false" style="padding: 12px 12px;">
                                            Log In
                                        </a>

                                        <div class="dropdown-menu .text-dark">
                                            <a class="dropdown-item" href="user_login.php">User</a>
                                            <a class="dropdown-item" href="agency_login.php">Agency</a>
                                            <a class="dropdown-item" href="worker_login.php">Workers</a>
                                            <a class="dropdown-item" href="admin_login.php">Admin</a>
                                        </div>
                                    </div>
                                </li>

                                <li class="add-listing theme-bg">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false" style="padding: 12px 1`2px; color:white">
                                            Sign Up
                                        </a>

                                        <div class="dropdown-menu .text-dark">
                                            <a class="dropdown-item" href="user_signup.php"
                                                style="margin-top:10px;">User</a>
                                            <a class="dropdown-item" href="agency_signup.php">Agency</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="nav-menus-wrapper" style="transition-property: none;">
                        <ul class="nav-menu">

                            <li><a href="#">Home</a> </li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Categories</a></li>
                            <li><a href="#">Agencies</a></li>
                            <li><a href="#">Testimonial</a> </li>
                            <li><a href="#">Contact</a></li>
                        </ul>

                        <ul class="nav-menu nav-menu-social align-to-right">
                            <li>

                                <div class="dropdown">
                                    <a class="dropdown-toggle ft-medium" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false" style="padding: 22px 22px;">
                                        Log In
                                    </a>

                                    <div class="dropdown-menu .text-dark">
                                        <a class="dropdown-item" href="user_login.php">User</a>
                                        <a class="dropdown-item" href="agency_login.php">Agency</a>
                                        <a class="dropdown-item" href="worker_login.php">Workers</a>

                                        <a class="dropdown-item" href="admin_login.php">Admin</a>
                                    </div>
                                </div>
                            </li>

                            <li class="add-listing theme-bg">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                        aria-expanded="false" style="padding: 22px 22px; color:white">
                                        Sign Up
                                    </a>

                                    <div class="dropdown-menu .text-dark">
                                        <a class="dropdown-item" href="user_signup.php"
                                            style="margin-top:10px;">User</a>
                                        <a class="dropdown-item" href="agency_signup.php">Agency</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- End Navigation -->
        <div class="clearfix"></div>


        <!-- ======================= Home Banner ======================== -->
        <div class="home-banner margin-bottom-0 intro-bg intro-banner">
            <div class="container">

                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5 col-lg-7 col-md-7 col-sm-12 col-12">
                        <form class="bg-white rounded p-4">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <h2 class="mb-0 ft-bold">700+ Service Agencies</h2>
                                        <p class="fs-md text-muted">The ultimate destination for your hiring needs!</p>
                                    </div>

                                    <div class="form-group position-relative">
                                        <input type="text" class="form-control lg form-ico"
                                            placeholder="Location or Zip Code" />
                                        <i class="bnc-ico lni lni-target"></i>
                                    </div>
                                    <div class="form-group position-relative">
                                        <select class="custom-select lg border">
                                            <option value="1">Vet Services</option>
                                            <option value="2">Home and Garden</option>
                                            <option value="3">Travel and Tourism</option>
                                            <option value="4">Cleaning Services</option>
                                            <option value="5">Repair & Maintenance Services</option>
                                            <option value="6">Transportation Services</option>
                                            <option value="7">Personal Services</option>
                                            <option value="8">Event Services</option>
                                        </select>
                                    </div>
                                    <div class="form-group position-relative">
                                        <button class="btn full-width custom-height-lg theme-bg text-white fs-md"
                                            type="button">Find Help</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="top-searches-key">
                            <ul class="p-0 mt-4 align-items-center d-flex">
                                <li><span class="text-dark ft-medium medium">Top Searches:</span></li>
                                <li><a href="javascript:void(0);" class="">Home and Garden</a></li>
                                <li><a href="javascript:void(0);" class="">Transportation </a></li>
                                <li><a href="javascript:void(0);" class="">Vet Services</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-5 col-md-5 col-sm-12 col-12">
                        <div class="bnr_thumb position-relative">
                            <img src="assets/img/intro.png" class="img-fluid bnr_img" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ======================= Home Banner ======================== -->
        <!-- ======================= About Us Detail ======================== -->
        <section class="middle">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="sec_title position-relative text-center mb-5">
                            <h6 class="text-muted mb-0">About Us</h6>
                            <h2 class="ft-bold">What We Do?</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="abt_caption">
                            <h2 class="ft-medium mb-4">We Have Everything You Need ?</h2>
                            <p class="mb-4">Khoj is an online hiring website that helps customers find the best service
                                provider for their needs. Our mission at Khoj is to make finding reliable, trustworthy
                                service providers more accessible and transparent. We provide a platform where customers
                                can find qualified, experienced professionals who can deliver the services they need. At
                                Khoj, we understand how difficult it can be to find the right service provider for your
                                needs. That’s why we have made it our mission to make finding the perfect service
                                provider easier and more convenient for you.
                                <br><br>
                                Our website is designed to help you quickly
                                and easily find the best service provider for your needs. We have a vast network of
                                experienced professionals who can provide a wide range of services, from plumbing,
                                electrical, carpentry, landscaping, painting, and more. Our website features an
                                easy-to-use search system that allows you to find the right service providers in your
                                area quickly. You can also browse our extensive list of service providers to get more
                                information on their services.
                            </p>

                            <div class="form-group mt-4">
                                <a href="#" class="btn theme-bg text-white">See More Info</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="abt_caption">
                            <img src="assets/img/about-1.png" class="img-fluid rounded" alt="" />
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ======================= About Us End ======================== -->
        <!-- ======================= All category ======================== -->
        <section class="space gray">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="sec_title position-relative text-center mb-5">
                            <h6 class="text-muted mb-0">Popular Categories</h6>
                            <h2 class="ft-bold">Top Agency Categories</h2>
                        </div>
                    </div>
                </div>

                <!-- row -->
                <div class="row align-items-center">
                    <?php 
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            while($row=mysqli_fetch_assoc($result)){
                            $id=$row['category_id'];

                            $category_name=$row['category_name'];
                            $category_img=$row['category_img'];
                    ?>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="cats-wrap text-center">
                            <a href="#" class="cats-box d-block rounded bg-white px-2 py-4" style="height:12rem">
                                <div
                                    class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                    <img src="assets/img/category/<?php echo $category_img?>" alt=""></div>
                                <div class="cats-box-caption">
                                    <h4 class="fs-md mb-0 ft-medium m-catrio"><?php echo $category_name?></h4>
                                    <span class="text-muted">607 Jobs</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php 
                            }
                        }
                    ?>
                </div>
                <!-- /row -->



            </div>
        </section>
        <!-- ======================= All category ======================== -->

        <!-- ======================= Job List ======================== -->
        <section class="middle">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="sec_title position-relative text-center mb-5">
                            <h6 class="text-muted mb-0">Trending Jobs</h6>
                            <h2 class="ft-bold">All Popular Listed jobs</h2>
                        </div>
                    </div>
                </div>


                <!-- All jobs -->
                <div class="row">
                    <?php 
												$sql = "SELECT * FROM agency";
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
                    <!-- Single -->
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="job_grid border rounded ">

                            <div class="job_grid_thumb mb-2 pt-5 px-3">
                                <a href="user_login.php" class="d-block text-center m-auto"><img
                                        src="assets/img/agency/<?php echo $agency_img?>" class="img-fluid" width="70"
                                        alt="" /></a>
                            </div>
                            <div class="job_grid_caption text-center pb-3 px-3">
                                <h4 class="mb-0 ft-medium medium"><a href="user_login.php"
                                        class="text-dark fs-md"><?php echo $agency_name?></a></h4>
                                <div class="jbl_location"><span><?php echo $category_name?></span></div>
                                <div style="padding-left:30%">
                                    <div class="d-flex">
                                        <div class="star-rating align-items-center d-flex" style="padding:0;margin:0;">
                                            <i class="fas fa-star filled"></i>
                                        </div>
                                        <div style="margin-top:10px">
                                            <p> 4.5 (200)</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="job_grid_footer pb-4 px-3 text-center">
                                <span class="mr-2 mb-2 d-inline-flex px-2 py-1 rounded text-danger bg-light-danger">
                                    Average Fee: <?php echo $cost?></span>
                            </div>
                        </div>
                    </div>
                    <?php 
													}
												}
											?>
                </div>


                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="position-relative text-center">
                            <a href="job-search-v1.html"
                                class="btn btn-md theme-bg rounded text-light hover-theme">Explore More Jobs<i
                                    class="lni lni-arrow-right-circle ml-2"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- ======================= Job List ======================== -->

        <!-- ======================= Customer Review ======================== -->
        <section class="middle gray">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="sec_title position-relative text-center mb-5">
                            <h6 class="text-muted mb-0">Our Reviews</h6>
                            <h2 class="ft-bold">What Our Customer <span class="theme-cl">Saying</span></h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="review-slide px-3">

                            <!-- single review -->
                            <div class="single_review px-2">
                                <div class="reviews_wrap position-relative bg-white rounded py-4 px-4">
                                    <div class="rw-header d-flex align-items-center justify-content-start">
                                        <div class="rv-110-thumb position-relative verified-author"><img
                                                src="assets/img/team-3.jpg" class="img-fluid circle" width="70"
                                                alt="" /></div>
                                        <div class="rv-110-caption pl-3">
                                            <h4 class="ft-medium fs-md mb-0 lh-1">Alvin B. Washington</h4>
                                            <div style="margin-top:7px;">
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rw-header d-flex mt-3">
                                        <p>Khoj is an excellent service hiring website that I recently used to hire a
                                            plumber. The interface was user-friendly and I was able to find the ideal
                                            plumber for my needs very quickly. The plumber I hired was highly
                                            experienced and did an excellent job. I'm very happy with the service and
                                            would definitely recommend it.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- single review -->
                            <div class="single_review px-2">
                                <div class="reviews_wrap position-relative bg-white rounded py-4 px-4">
                                    <div class="rw-header d-flex align-items-center justify-content-start">
                                        <div class="rv-110-thumb"><img src="assets/img/team-4.jpg"
                                                class="img-fluid circle" width="70" alt="" /></div>
                                        <div class="rv-110-caption pl-3">
                                            <h4 class="ft-medium fs-md mb-0 lh-1">Lavera C. Clifford</h4>
                                            <div style="margin-top:7px;">
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rw-header d-flex mt-3">
                                        <p>I hired a house cleaner from Khoj and was extremely pleased with the
                                            experience. The website was easy to use and I was able to find exactly the
                                            kind of cleaner I needed. The cleaner was friendly and professional and did
                                            a great job. I would definitely recommend Khoj to anyone looking for a
                                            reliable service.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- single review -->
                            <div class="single_review px-2">
                                <div class="reviews_wrap position-relative bg-white rounded py-4 px-4">
                                    <div class="rw-header d-flex align-items-center justify-content-start">
                                        <div class="rv-110-thumb position-relative verified-author"><img
                                                src="assets/img/team-2.jpg" class="img-fluid circle" width="70"
                                                alt="" /></div>
                                        <div class="rv-110-caption pl-3">
                                            <h4 class="ft-medium fs-md mb-0 lh-1">Linda S. Riggs</h4>
                                            <div style="margin-top:7px;">
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rw-header d-flex mt-3">
                                        <p>Khoj made hiring a carpenter for my home renovation project incredibly easy.
                                            After reading through the reviews on the website I chose the perfect
                                            carpenter for my job. He was punctual, and professional and did an excellent
                                            job. I was very happy with the service Khoj provided and would definitely
                                            use their website again.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- single review -->
                            <div class="single_review px-2">
                                <div class="reviews_wrap position-relative bg-white rounded py-4 px-4">
                                    <div class="rw-header d-flex align-items-center justify-content-start">
                                        <div class="rv-110-thumb"><img src="assets/img/team-5.jpg"
                                                class="img-fluid circle" width="70" alt="" /></div>
                                        <div class="rv-110-caption pl-3">
                                            <h4 class="ft-medium fs-md mb-0 lh-1">Chris L. Hazel</h4>
                                            <div style="margin-top:7px;">
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rw-header d-flex mt-3">
                                        <p>I recently used Khoj to hire a mechanic to service my car. After reading
                                            through the reviews, I chose the perfect mechanic for the job. He was very
                                            professional and did a great job. The whole process was made incredibly easy
                                            by Khoj, and I would recommend their website to anyone looking for a
                                            reliable service.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- single review -->
                            <div class="single_review px-2">
                                <div class="reviews_wrap position-relative bg-white rounded py-4 px-4">
                                    <div class="rw-header d-flex align-items-center justify-content-start">
                                        <div class="rv-110-thumb position-relative verified-author"><img
                                                src="assets/img/team-1.jpg" class="img-fluid circle" width="70"
                                                alt="" /></div>
                                        <div class="rv-110-caption pl-3">
                                            <h4 class="ft-medium fs-md mb-0 lh-1">Mark Jukerberg</h4>
                                            <div style="margin-top:7px;">
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                                <i class="fa-solid fa-star" style=></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rw-header d-flex mt-3">
                                        <p>I used Khoj to hire a gardener to care for my garden. The website was easy to
                                            use, and I could find the perfect gardener quickly. He was friendly and
                                            professional and did an excellent job. I'm very happy with the service Khoj
                                            provided and would highly recommend them to anyone looking for a reliable
                                            service.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================= Customer Review ======================== -->


        <!-- ======================= Contact Page Detail ======================== -->
        <section class="middle">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="sec_title position-relative text-center mb-5">
                            <h6 class="text-muted mb-0">Contact Us</h6>
                            <h2 class="ft-bold">Send us a <span class="theme-cl">Message</span></h2>
                        </div>
                    </div>
                </div>

                <div class="row align-items-start justify-content-between">

                    <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                        <form class="row">

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Your Name *</label>
                                    <input type="text" class="form-control" value="Your Name">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Your Email *</label>
                                    <input type="text" class="form-control" value="Your Email">
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Subject</label>
                                    <input type="text" class="form-control" value="Type Your Subject">
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="small text-dark ft-medium">Message</label>
                                    <textarea class="form-control ht-80" placeholder="Write Something ..."></textarea>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-dark">Send Message</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </section>
        <!-- ======================= Contact Page End ======================== -->

        <!-- ============================ Footer Start ================================== -->
        <footer class="dark-footer skin-dark-footer style-2">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">
                                <img src="assets/img/logo-light.png" class="img-footer small mb-2" alt="" />

                                <div class="address mt-2">
                                    Mohammadpur Dhaka - 1207
                                </div>
                                <div class="address mt-3">
                                    +880-1345263746<br>support@khoj.com
                                </div>
                                <div class="address mt-2">
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="#" class="theme-cl"><i
                                                    class="lni lni-facebook-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#" class="theme-cl"><i
                                                    class="lni lni-twitter-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#" class="theme-cl"><i
                                                    class="lni lni-youtube"></i></a></li>
                                        <li class="list-inline-item"><a href="#" class="theme-cl"><i
                                                    class="lni lni-instagram-filled"></i></a></li>
                                        <li class="list-inline-item"><a href="#" class="theme-cl"><i
                                                    class="lni lni-linkedin-original"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">For Employers</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Post Job</a></li>
                                    <li><a href="#">Shortlisted</a></li>
                                    <li><a href="#">View Candidates</a></li>
                                    <li><a href="#">Hire Candidates</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">For Candidates</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Explore All Jobs</a></li>
                                    <li><a href="#">Browse Categories</a></li>
                                    <li><a href="#">Saved Jobs</a></li>
                                    <li><a href="#">Hired</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">About Company</h4>
                                <ul class="footer-menu">
                                    <li><a href="#">Who We arer?</a></li>
                                    <li><a href="#">Our Mission</a></li>
                                    <li><a href="#">Packages</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer_widget">
                                <h4 class="widget_title">Subscribe to our Newsletter</h4>
                                <input type="text" class="form-control" placeholder="Email address"
                                    style="margin:10px 0">
                                <button class="btn btn-success" type="button">Subscribe</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
        <!-- ============================ Footer End ================================== -->


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