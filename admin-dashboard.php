<?php include_once 'staff-header.php'; ?>
				<div class="col-md-10">
                	<div class="row">
						<div class="col-md-12">
							<div class="card mb-4 p-2">
								<div class="row">
									<div class="col-1"><span class="dashboard-avatar"><?php echo substr($session->get_session('firstname'), 0,1); ?></span></div>
									<div class="col-11">
										<div class="dashboard-username"><?php echo $session->get_session('firstname') . " " . $session->get_session('lastname'); ?></div>
										<div class="dashboard-department">
											<span class="badge badge-dark"> Staff Member </span>
												<span class="badge badge-pill">for</span>
												<?php if($session->get_session('permission_admin')) { ?><span class="badge badge-pill badge-secondary"> Administration </span> <?php } ?>
												<?php if($session->get_session('permission_store')) { ?><span class="badge badge-pill badge-secondary"> Stores </span> <?php } ?>
												<?php if($session->get_session('permission_accounts')) { ?><span class="badge badge-pill badge-secondary"> Accounts </span> <?php } ?>
												<?php if($session->get_session('permission_showroom')) { ?><span class="badge badge-pill badge-secondary"> Showroom </span> <?php } ?>
												<?php if($session->get_session('permission_employees')) { ?><span class="badge badge-pill badge-secondary"> Employee </span> <?php } ?>
										</div>
                					</div>
                					</div>
                				</div>
                			</div>
                		</div>
					<div class="row">
							<div class="col-md-12">
								<div class="card bg-light mb-3">
									<div class="card-header">Administration</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-3">
												<div class="card mb-4 p-2" style="background-color:#e2e8e5">
													<img height="250" width="200" class="card-img-top p-4" src="assets/images/businessman.png" alt="Image">
													<div class="card-body">
														<a href="admin-staff-add.php" class="btn btn-lg btn-dark btn-block"> Manage Users </a>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="card mb-4 p-2" style="background-color:#e2e8e5">
													<img height="250" width="200" class="card-img-top p-4" src="assets/images/businessman.png" alt="Image">
													<div class="card-body">
														<a href="admin-branch-add.php" class="btn btn-lg btn-dark btn-block"> Manage Branches </a>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="card mb-4 p-2" style="background-color:#e2e8e5">
													<img height="250" width="200" class="card-img-top p-4" src="assets/images/businessman.png" alt="Image">
													<div class="card-body">
														<a href="admin-manage-departments.php" class="btn btn-lg btn-dark btn-block"> Departments </a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>
