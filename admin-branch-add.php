<?php include_once 'staff-header.php'; ?>
<?php

	$Helpers = new Helpers();
	$userid = $Helpers->generate_userid();

	if (isset($_POST['add_branch'])) {
		$branchname = $_POST['bname'];
		$departmenttype = $_POST['departmenttype'];
		$address = $_POST['address'];
		$telno = $_POST['telno']; 
		$BranchManager = new BranchManager();
		$branch_creation_status = $BranchManager->add_branch($branchname, $departmenttype, $address, $telno);

		if($branch_creation_status) {
			set_success_msg("<strong>Success!</strong> New Branch has been successfully added to the system!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to add new branch!");
		}

		header('Location: admin-branch-add.php');
	}
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a href="admin-branch-add.php" class="nav-item nav-link active">Add</a>
							<a href="admin-branch-search.php" class="nav-item nav-link disabled">Search</a>
							<a href="staff-attendance.php" class="nav-item nav-link disabled">Attendance</a>
							<a href="staff-departments.php" class="nav-item nav-link disabled">Departments</a>
							<a href="staff-overview.php" class="nav-item nav-link disabled">Overview</a>
							<a href="staff-reports.php" class="nav-item nav-link disabled">Reports</a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="admin-branch-add.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Branch Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="bname" id="bname" placeholder=" Branch Name " required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Department Type</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
                                                <select size="4" name="departmenttype" class="form-control">
													<option value="Administration" selected>Administration</option>
													<option value="Store">Store</option>
													<option value="Accounts">Accounts</option>
													<option value="Showroom">Showroom</option>
                                                </select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Address</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<textarea type="text" class="form-control" name="address" id="address" placeholder=" Address " rows="4" maxlength="512" required></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Telephone No.</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="telno" id="telno" placeholder=" Telephone No. " required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<input type="submit" value=" Add Branch " name="add_branch" class="btn btn-dark">
									</div>
									<div class="col-sm-4">
										<button name="add" type="button" class="btn btn-primary" onclick="autofill()">Demo</button>
										<script>
										function autofill() {
											document.getElementById('bname').value = "Nawala - Super Grade Showroom";
											document.getElementById('telno').value = "0782168254";
											document.getElementById('address').value = "No 1337,\nMain Street,\nColombo 12.";
										}
										</script>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
