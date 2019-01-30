<?php include_once 'staff-header.php'; ?>
<?php $BranchManager = new BranchManager(); ?>
<?php
	if(isset($_GET['bid'])) {
        $branches = $BranchManager->get_single_branch($_GET['bid'])[0];
    } else {
        header('Location: admin-branch-search.php');
    }

$department = array();
array_push($department,'Administration','Showroom','Store','Accounts');
?>
<?php

	if (isset($_POST['update_branch'])) {
		$bid = $_POST['id'];
		$branchname = $_POST['bname'];
		$departmenttype = $_POST['departmenttype'];
		$address = $_POST['address'];
		$telno = $_POST['telno']; 
		$BranchManager = new BranchManager();
		$branch_updation_status = $BranchManager->update_branch($bid, $branchname, $departmenttype, $address, $telno);

		if($branch_updation_status) {
			set_success_msg("<strong>Success!</strong> Branch has been successfully updateded to the system!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to update the branch!");
		}

		header('Location: admin-branch-search.php');
	}

	if (isset($_POST['delete_branch'])) {
		$bid = $_POST['id'];
		$BranchManager = new BranchManager();
		$branch_deletion_status = $BranchManager->delete_branch($bid);

		if($branch_deletion_status) {
			set_success_msg("<strong>Success!</strong> Branch has been successfully deleted from the system!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to delete the branch!");
		}

		header('Location: admin-branch-search.php');
	}
	
?>
				<div class="col-md-10">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<?php
                            $sql = "SELECT * FROM company_branches";
							$result = Database::$DB_CONN->query($sql);
							$row = mysqli_num_rows($result);
							?>
							<a href="admin-branch-add.php" class="nav-item nav-link"><strong> Add Branch </strong></a>
							<a href="admin-branch-search.php" class="nav-item nav-link active"><strong> Search Branch 
							<?php if($row > 0){
									echo "<span class='badge badge-success badge-pill'> ".$row." <span>";
								  } 
							?>
							</strong></a>
							<a href="admin-branch-permit.php" class="nav-item nav-link"><strong> Permit Branch 
							<?php if($row > 0){
									echo "<span class='badge badge-danger badge-pill'> ".$row." <span>";
								  } 
							?>
							</strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="post" action="admin-branch-profile.php">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Branch Name</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="text" class="form-control" name="bname" id="bname" placeholder=" Branch Name " value="<?php echo $branches['name'] ?>" required>
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
													<option value="<?php echo $branches['type'];  ?>" selected><?php echo $branches['type'] ?></option>
													<?php
														foreach($department as $singledept){
															if($singledept == $branches['type']){continue;}
													?>
													<option value="<?php echo $singledept; ?>"><?php echo $singledept; ?></option>
													<?php
														}
													?>
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
												<textarea type="text" class="form-control" name="address" id="address" placeholder=" Address " rows="4" maxlength="512" required><?php echo $branches['location']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Telephone No.</label>
									<div class="col-sm-10">
										<div class="form-row">
											<div class="col-md-6">
												<input type="hidden" value="<?php echo $branches['id'] ?>" name="id">
												<input type="text" class="form-control" name="telno" id="telno" value="<?php echo $branches['phoneno']; ?>" placeholder=" Telephone No. " required>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row mt-5">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" name="update_branch" value="1" class="btn btn-dark">Update Branch</button>
                                    </div>
									<div class="col-sm-3" style="text-align: right;">
                                        <button type="submit" name="delete_branch" value="1" class="btn btn-danger">Remove Branch</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
