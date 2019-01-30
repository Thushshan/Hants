<?php include_once 'staff-header.php'; ?>
<?php
	if (isset($_GET['s'])) {
		$query = $_GET['s'];
		$StaffManager = new StaffManager();
		$users = $StaffManager->get_employees($query);
	} else {
		$BranchManager = new BranchManager();
		$branch = $BranchManager->get_branch_list();
	}


	function check_status($status){
		if($status == "active"){
			return "pending";
		}
		else{
			return "closed";
		}
	}
	
	function change_status($status){
		if($status == "active"){
			return " &nbsp;"." Block "."&nbsp;";
		}
		else{
			return "Unblock";
		}
	}

	if(isset($_POST['block'])){
		$BranchManager = new BranchManager();
		$block_status = $BranchManager->block_branch($_POST['id']);

		if ($block_status) {
			set_success_msg("<strong>Success!</strong> Branch Location has been successfully blocked!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to block the location!..");
		}
		header('Location: admin-branch-permit.php');
	}
	
	if(isset($_POST['unblock'])){
		$BranchManager = new BranchManager();
		$block_status = $BranchManager->unblock_branch($_POST['id']);

		if ($block_status) {
			set_success_msg("<strong>Success!</strong> Branch Location has been successfully unblocked!");
		} else {
			set_error_msg("<strong>Failed!</strong> Something strange happened while trying to unblock the location!..");
		}
		header('Location: admin-branch-permit.php');
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
							<a href="admin-branch-search.php" class="nav-item nav-link"><strong> Search Branch 
							<?php if($row > 0){
									echo "<span class='badge badge-danger badge-pill'> ".$row." <span>";
								  } 
							?>
							</strong></a>
							<a href="admin-branch-permit.php" class="nav-item nav-link active"><strong> Permit Branch 
							<?php if($row > 0){
									echo "<span class='badge badge-success badge-pill'> ".$row." <span>";
								  } 
							?>
							</strong></a>
						</div>
					</nav>
					<div class="tab-content">
						<div class="tab-pane mt-4 show active">
							<form method="get" action="staff-search.php">
								<div class="row">
									<div class="col-md-12">
										<div class="input-group mb-3">
											<input type="text" value="<?php echo $retVal = (isset($_GET['s'])) ? $_GET['s'] : '' ; ?>" name="s" class="form-control" placeholder="Employee id, name, mobile, email" aria-label="Recipient's username" aria-describedby="basic-addon2" pattern="[A-Za-z0-9@.]{3,49}" required>
											<div class="input-group-append">
												<button class="btn btn-dark" type="submit">Search</button>
											</div>
										</div>
									</div>
								</div>
							</form>
								<div class="row">
									<div class="col-md-12">
									<?php if(!empty($branch)) { 
										$x = 1;
										?>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Branch Name</th>
													<th scope="col">Department</th>
													<th scope="col">Location</th>
													<th scope="col">Telephone No.</th>
													<th scope="col">Status</th>
													<th scope="col">Operation</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($branch as $singlebranch) { ?>
												<tr>
													<th><?php echo $x++; ?></th>
													<td><?php echo $singlebranch['name']; ?></td>
													<td><?php echo $singlebranch['type']; ?></td>
													<td><?php echo $singlebranch['location']; ?></td>
													<td><?php echo $singlebranch['phoneno']; ?></td>
													<th class="<?php echo check_status($singlebranch['status']); ?>"><?php echo $singlebranch['status']; ?></th>
													<td>
														<div class="btn-group" role="group" aria-label="Basic example">
															<form action="admin-branch-permit.php" method="post">
																<input type="hidden" value="<?php echo $singlebranch['id']; ?>" name="id">
																<button name="<?php echo (check_status($singlebranch['status'])=="pending")? "block": "unblock"; ?>" type="submit" class="btn <?php echo (check_status($singlebranch['status'])=="pending")? "btn-danger": "btn-success"; ?>"><?php echo change_status($singlebranch['status']); ?></button>
															</form>
														</div>
													</td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
									<?php } else { ?>
										<div class="alert alert-danger" role="alert">No matching records found!</div>
									<?php } ?>
									</div>
								</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
