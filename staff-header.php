<?php
	include_once 'common_functions.php';
	include_once 'ClassEmployee.php';

	$AuthHandler = new AuthHandler();
	if (!$AuthHandler->auth_status()) {
		header('Location: login.php');
	}

	$session = new SessionManager();
?>
<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Hants (PVT) LTD Sales System | Dashboard</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/Finance_Style.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
			<a class="navbar-brand" href="dashboard.php"><strong class="ml-3">Hants (PVT) LTD Sales System</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<span class="navbar-nav mr-auto"></span>
				<ul class="navbar-nav">
					<li class="nav-item"><a href="profile.php" class="badge badge-pill badge-secondary" style="margin-top: 11px;margin-right: 12px;<?php echo (is_on_page("profile")) ? 'background-color: #d6d8db;' : '' ; ?>color: #343a40;"><?php echo $session->get_session('firstname') . ' ' . $session->get_session('lastname'); ?></a></li>
					<li class="nav-item <?php $active_state = (is_on_page("dashboard")) ? 'active' : '' ; echo $active_state; ?>"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
					<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid">
			<?php if(has_error_msg()) { ?>
				<div class="alert alert-danger" role="alert"><?php echo get_error_msg(); ?></div>
			<?php }	?>
			<?php if(has_success_msg()) { ?>
				<div class="alert alert-success" role="alert"><?php echo get_success_msg(); ?></div>
			<?php }	?>
			<div class="row">
				<div class="col-md-2">
					<div class="list-group mb-5">
						<?php if($session->get_session('permission_admin')) { ?>
							<a href="admin-dashboard.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("adminstration")) ? 'active' : '' ; echo $active_state; ?>"> Administration </a>
						<?php } ?>
						<?php if($session->get_session('permission_store')) { ?>
							<a href="stores_dashboard.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("stores")) ? 'active' : '' ; echo $active_state; ?>"> Stores </a>
						<?php } ?>
						<?php if($session->get_session('permission_accounts')) { ?>
							<a href="accounts_dashboard.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("accounts")) ? 'active' : '' ; echo $active_state; ?>"> Accounts </a>
						<?php } ?>
						<?php if($session->get_session('permission_showroom')) { ?>
							<a href="showroom_dashboard.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("showroom")) ? 'active' : '' ; echo $active_state; ?>"> Showroom </a>
						<?php } ?>
						<?php if(true /* $session->get_session('permission_employees') */ ) { ?>
							<a href="profile.php" class="list-group-item list-group-item-action list-group-item-secondary <?php $active_state = (is_on_page("profile")) ? 'active' : '' ; echo $active_state; ?>">Profile</a>
						<?php } ?>
					</div>
				</div>
