<?php
	include_once 'common_functions.php';
	include_once 'ClassEmployee.php';
	$session = new SessionManager();

  
	$AuthHandler = new AuthHandler();
	if ($AuthHandler->auth_status()) {
		header('Location: dashboard.php');
	}

	if (isset($_POST['login'])) {
		$method = $_POST['method'];
		$username = $_POST['username'];
		$userid = $_POST['employeeid'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		if($method == "email"){
			 if(empty($email) || $email == null || $email == ""){
				 set_error_msg("<strong> Login Failed! </strong> Email ID or Password is Empty!... ");
				 header('Location: login.php');
			 }else{
				 $check_login = $AuthHandler->check_login_credentials_email($email, $password);
				 
				 if($check_login){
					 $user_status = $AuthHandler->check_userstatus_email($email, $password);
					 
					 if($user_status == "blocked"){
						 set_error_msg("<strong> Login Failed!</strong> User has been temporarily blocked by the Administrator!... ");
				 	 	 header('Location: login.php');
					 }
					 else if($user_status == "firsttime"){
						 set_error_msg("<strong> Login First Time! </strong> Reset your Password and Re-login!... ");
						 $session->set_session(RESET_PASSWORD,'YES');
						 header('Location: reset-password.php');
					 }
					 else{
						 $password_expiry = $AuthHandler->check_password_expiry_email($email, $password);
						 
						 if($password_expiry){
							 $login_state = $AuthHandler->login_with_email($email, $password);
							 
							 if($login_state){
								 set_success_msg("<strong> Welcome back!</strong> Hants (PVT) LTD Sales System!...");
								 header('Location: dashboard.php');
							 }
							 else{
								 set_error_msg("<strong> Login Failed!</strong> Log in Credentials are incorrect!... ");
				 	 	 		 header('Location: login.php');
							 }	 
						 }
						 else{
							 set_error_msg("<strong> Login Failed!</strong> Your Password Expired!.. Please Change and Re-login... ");
							 $session->set_session(RESET_PASSWORD,'YES');
				 	 	 	 header('Location: reset-password.php');
						 }
						 
					 }
					 
				 }else{
					 set_error_msg("<strong> Login Failed!</strong> Email ID or Password is Incorrect!... ");
				 	 header('Location: login.php'); 
				 }
				 
			 }	
		}else if($method == "employeeid"){
			 if(empty($userid) || $userid == null || $userid == ""){
				 set_error_msg("<strong> Login Failed!</strong> Employee ID or Password is Empty!... ");
				 header('Location: login.php');
			 }else{
				 $login_state = $AuthHandler->login_with_userid($userid, $password);

				 if ($login_state) {
					header('Location: dashboard.php');
				 } else {
					 set_error_msg("<strong> Login Failed!</strong> Employee ID or Password is Incorrect!... ");
				 	 header('Location: login.php');
				 }
				 
			 }			
			
		}else if($method == "username"){
			 if(empty($username) || $username == null || $username == ""){
				 set_error_msg("<strong> Login Failed!</strong> Username or Password is Empty!... ");
				 header('Location: login.php');
			 }else{
				 $login_state = $AuthHandler->login_with_username($username, $password);

				 if ($login_state) {
					header('Location: dashboard.php');
				 } else {
					 set_error_msg("<strong> Login Failed!</strong> Username or Password is Incorrect!... ");
				 	 header('Location: login.php');
				 }
				 
			 }			
		}else{
			 set_error_msg("<strong> Login Failed!</strong> Select a Login Method!... ");
			 header('Location: login.php');

		}

	}
	
?>
<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Hants (PVT) LTD Sales System | Login</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link href="assets/css/quill.snow.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
			<a class="navbar-brand" href="/"> Hants (PVT) LTD Sales System </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<span class="navbar-nav mr-auto"></span>
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<?php    if(has_error_msg()) { ?>
				<div class="alert alert-danger" role="alert"><?php echo get_error_msg(); ?></div>
			<?php }	?>
			<div class="row">  
				<div class="col-md-6 offset-md-3 mt-5">
					<div style="text-align:center">
						<img src="assets/images/sis-logo-md.png" alt="" style="width: 250px; height: 200px;margin: 0px auto 0px;">
					</div>
					<div class="card">
						<h5 class="card-header">Log in</h5>
						<div class="card-body">
							<form action="login.php" method="post">
								<div class="form-group">
									<label for="method"> Method </label>
									<select name="method" class="form-control" id="methodlogin" onChange="loginmethod(this)">
  										<option value="selected" selected> Select a Method </option>
  										<option value="email"> Email ID </option>
  										<option value="employeeid"> Employee ID </option>
  										<option value="username"> Username </option>
									</select>
									<small class="form-text font-weight-bold" style="color: red"> * Required *  </small>
								</div>
								<div class="form-group login-method-none" id="emailgroup">
									<label for="email"> Email ID </label>
									<input type="email" placeholder=" Email ID " class="form-control" id="email" name="email">
									<small class="form-text font-weight-bold" style="color: red"> * Required *  </small>
								</div>
								<div class="form-group login-method-none" id="employeeidgroup">
									<label for="employeeid"> Employee ID </label>
									<input type="text" placeholder=" Employee ID " class="form-control" id="employeeid" name="employeeid">
									<small class="form-text font-weight-bold" style="color: red"> * Required *  </small>
								</div>
								<div class="form-group login-method-none" id="usernamegroup">
									<label for="username"> Username </label>
									<input type="text" placeholder=" Username " class="form-control" id="username" name="username">
									<small class="form-text font-weight-bold" style="color: red"> * Required *  </small>
								</div>
								<div class="form-group login-method-none" id="passwordgroup">
									<label for="password"> Password </label>
									<div class="input-group">
  										<input type="password" placeholder=" Password " class="form-control" aria-label="Text input with checkbox" id="password" name="password">
										<div class="input-group-append">
    										<div class="input-group-text">
      											<input type="checkbox" id="viewpassword" aria-label="Checkbox for following text input" onClick="view_password()"> &nbsp; View
    										</div>
  										</div>
									</div>
									<small class="form-text font-weight-bold" style="color: red"> * Required *  </small>
								</div>
								<div class="form-group login-method-none" id="login">
								<center>
								<input type="submit" class="btn btn-lg btn-dark" value="Log in" name="login">
								</center> 
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
		<script src="assets/js/style.js"></script>
	</body>
</html>
