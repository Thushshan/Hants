<?php
	include_once 'ClassEmployee.php';

	$AuthHandler = new AuthHandler();
	if ($AuthHandler->auth_status()) {
		$AuthHandler->logout();
	}
	header('Location: login.php');
?>
