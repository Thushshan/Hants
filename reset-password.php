<?php

	include_once 'common_functions.php';
	include_once 'ClassEmployee.php';
	$session = new SessionManager();
	$AuthHandler = new AuthHandler();
	if ($AuthHandler->auth_status()) {
		header('Location: dashboard.php');
	}

if($session->get_session("reset_password") == "YES" && $session->get_session("reset_password_user") != null){


	if (isset($_POST['reset'])) {
		$confirmpassword = $_POST['confirmpassword'];
		$password = $_POST['password'];
		
		if($confirmpassword != $password){
			set_error_msg("<strong>Reset Failed!</strong> Two Passwords are not matching!...");
			header('Location: reset-password.php');
		}else{

		$reset_state = $AuthHandler->reset_password($session->get_session("reset_password_user"), $password);
		

		if ($reset_state) {
			$session->set_session(RESET_PASSWORD,"NO");
			$session->unset_session(RESET_PASSWORD_USER);
			set_error_msg("<strong>Reset Password Success! </strong> Try to Re-Login!...");
			header('Location: login.php');
		} else {
			set_error_msg("<strong>Reset Password Failed! ".$session->get_session("reset_password")." ".$session->get_session("reset_password_user")."hi </strong> Try Again once!...");
			header('Location: dashboard.php');
		}
			
		}
	}
	
?>
<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Hants (PVT) LTD Sales System | Reset Password</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link href="assets/css/quill.snow.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
			<a class="navbar-brand" href="/">Hants (PVT) LTD Sales System</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<span class="navbar-nav mr-auto"></span>
				<ul class="navbar-nav">
					<!--li class="nav-item"><a class="nav-link" href="login.php">Login</a></li-->
				</ul>
			</div>
		</nav>
		<div class="container">
			<?php if(has_error_msg()) { ?>
				<div class="alert alert-danger" role="alert"><?php echo get_error_msg(); ?></div>
			<?php }	?>
			<div class="row">
				<div class="col-md-6 offset-md-3 mt-5">
					<div style="text-align:center">
						<img src="assets/images/sis-logo-md.png" alt="" style="width: 150px;margin: 0px auto 30px;">
					</div>
					<div class="card">
						<h5 class="card-header">Reset Password</h5>
						<div class="card-body">
							<form action="reset-password.php" method="post">
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" placeholder=" Password " class="form-control" id="password" name="password" required>
									<small class="form-text font-weight-bold" style="color: red"> * Required *  </small>
								</div>
								<div class="form-group">
									<label for="confirmpassword">Confirm Password</label>
									<input type="password" placeholder=" Confirm Password " class="form-control" id="confirmpassword" name="confirmpassword" required>
									<small class="form-text font-weight-bold" style="color: red"> * Required *  </small>
								</div>
								<center><input type="submit" class="btn btn-lg btn-dark" value=" Reset " name="reset"></center>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
	</body>
</html>
<?php }else{
	header('Location: error_page.php');
} ?>
