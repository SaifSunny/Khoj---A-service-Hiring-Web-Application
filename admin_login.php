<?php

include './database/config.php';
error_reporting(0);

session_start();

if (isset($_SESSION['adminname'])) {
    header("Location: admin_home.php");
}

if (isset($_POST['submit'])) {

    $error = "";
    $cls="";

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM admin WHERE username='$username'";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {

        $sql = "SELECT * FROM admin WHERE `password`='$password'";
        $result = mysqli_query($conn, $sql);
    
        if ($result->num_rows > 0) {
            $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);
        
            if ($result->num_rows > 0) {
                $_SESSION['adminname'] = $_POST['username'];

                $sql = "INSERT INTO latest_users(`image`, `name`, `role`) VALUES ((SELECT `admin_img` FROM admin WHERE username='$username'), '$username', 'Admin')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: admin_home.php");
                }
                else {
                    $error = mysqli_error($conn);
                    $cls="danger";
                }
                
            } else {
                $error = mysqli_error($conn);
                $cls="danger";

            }
    
        } else {
            $error= "Woops! Password is Incorrect.";
            $cls="danger";

        }

	} else {
		$error= "Woops! Username is Incorrect.";
        $cls="danger";

	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Khoj - Service Hiring Website</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/plugins/portal.css">

</head>

<body class="app app-login p-0">
	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-12 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<h2 class="auth-heading text-center mb-5" style="margin-top:70px;">Log In</h2>
					<div class="auth-form-container text-start">
						<form class="auth-form login-form" method="post">
							<div class="alert alert-<?php echo $cls;?>">
								<?php 
                                    if (isset($_POST['submit'])){
                                        echo $error;
                                    }
                                ?>
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="username">Username</label>
								<input id="signin-email" name="username" type="text" class="form-control signin-email"
									placeholder="Username" required="required">
							</div>
							<!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Password</label>
								<input id="signin-password" name="password" type="password"
									class="form-control signin-password" placeholder="Password" required="required">
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value=""
												id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
												Remember me
											</label>
										</div>
									</div>
									<!--//col-6-->
									<div class="col-6">
										<div class="forgot-password text-end">
											<a href="">Forgot password?</a>
										</div>
									</div>
									<!--//col-6-->
								</div>
								<!--//extra-->
							</div>
							<!--//form-group-->
							<div class="text-center">
								<button type="submit" name="submit"
									class="btn app-btn-primary w-100 theme-btn mx-auto">Log
									In</button>
							</div>
						</form>

					</div>
					<!--//auth-form-container-->

				</div>
				<!--//auth-body-->

			</div>
			<!--//flex-column-->
		</div>
		<!--//auth-main-col-->

	</div>
	<!--//row-->


</body>

</html>