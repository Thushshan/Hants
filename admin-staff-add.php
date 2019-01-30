<?php include_once 'staff-header.php'; ?>
<?php

	$Helpers = new Helpers();
	$userid = $Helpers->generate_userid();

	if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['doby']) && isset($_POST['dobm']) && isset($_POST['dobd']) && isset($_POST['nic']) && isset($_POST['mobile_no']) && isset($_POST['address']) && isset($_POST['email'])) {
		$userid = $_POST['uid'];
		$uname = $_POST['uname'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$salary = $_POST['salary'];
		$nicno = $_POST['nic'];
		$dob = $_POST['doby'] . '-' . $_POST['dobm'] . '-' . $_POST['dobd'];
		$mobileno = $_POST['mobile_no'];
		$location = $_POST['address'];
		$email = $_POST['email'];
		$gender = $_POST['gender']; 
		$StaffManager = new StaffManager();
		$user_creation_status = $StaffManager->add_employee($userid, $uname, $fname, $lname, $gender, $dob, $mobileno, $email, $nicno, $location, $salary);

		if($user_creation_status) {
			set_success_msg("<strong>Success!</strong> New user has been successfully added to the system!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to add new employee!");
		}

		header('Location: admin-staff-add.php');
	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<?php
                            $sql = "SELECT * FROM employees";
							$result = Database::$DB_CONN->query($sql);
							$row = mysqli_num_rows($result);
							?>
							<a href="admin-staff-add.php" class="nav-item nav-link active"><strong> Add Employee </strong></a>
							<a href="admin-staff-search.php" class="nav-item nav-link"><strong> Search Employee 
							<?php if($row > 0){
									echo "<span class='badge badge-danger badge-pill'> ".$row." <span>";
								  } 
							?>
							</strong></a>
							<a href="admin-staff-permit.php" class="nav-item nav-link"><strong> Permit Employee 
							<?php if($row > 0){
									echo "<span class='badge badge-danger badge-pill'> ".$row." <span>";
								  } 
							?>
							</strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="admin-staff-add.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">User ID</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="uid" id="uid" placeholder="Username" value="<?php echo $userid; ?>" required readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-3">
												<input type="text" class="form-control" name="fname" id="fname" placeholder="First name" maxlength="50" pattern="[A-Za-z.]{3,49}" required>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="lname" id="lname" placeholder="Last name" maxlength="50" pattern="[A-Za-z.]{3,49}" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Username</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="uname" id="uname" placeholder="Username" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Date of Birth</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-2">
												<input type="number" class="form-control" name="doby" id="doby" placeholder="Year" min="1900" max="2100" required>
											</div>
											<div class="col-md-2">
												<input type="number" class="form-control" name="dobm" id="dobm" placeholder="Month" min="1" max="12" required>
											</div>
											<div class="col-md-2">
												<input type="number" class="form-control" name="dobd" id="dobd" placeholder="Date" min="1" max="31" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Basic Salary</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="number" class="form-control" name="salary" id="salary" placeholder="LKR" min="10000" max="1000000" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">NIC</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="nic" id="nic" placeholder="Ex: 123456789V" maxlength="10" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Contacts</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile" maxlength="10" required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<textarea type="text" class="form-control" name="address" id="address" placeholder="Address" rows="3" maxlength="512" required></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
											</div>
										</div>
									</div>
								</div>
								<fieldset class="form-group">
									<div class="row">
										<legend class="col-form-label col-sm-2 pt-0">Gender</legend>
										<div class="col-sm-10 col-md-2">
											<select name="gender" class="form-control" required>
												<option value="Male" selected>Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>
								</fieldset>
								<div class="form-group row">
									<div class="col-sm-6">
										<button type="submit" class="btn btn-dark">Add Employee</button>
									</div>
									<div class="col-sm-4">
										<button name="add" type="button" class="btn btn-primary" onclick="autofill()">Demo</button>
										<script>
										function autofill() {
											document.getElementById('fname').value = "John";
											document.getElementById('lname').value = "Doe";
											document.getElementById('uname').value = "john.d";
											document.getElementById('doby').value = 1993;
											document.getElementById('dobm').value = 04;
											document.getElementById('dobd').value = 05;
											document.getElementById('salary').value = 85000;
											document.getElementById('nic').value = "942565480v";
											document.getElementById('mobile_no').value = "0782168254";
											document.getElementById('address').value = "No 1337,\nMain Street,\nColombo 12.";
											document.getElementById('email').value = "johndoe@outlook.com";
										}
										</script>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
