<?php include_once 'staff-header.php'; ?>

                                    
                <div class="col-md-10">
                	<div class="row">
						<div class="col-md-12">
							<div class="card mb-4 p-2">
								<div class="row">
									<div class="col-1"><span class="dashboard-avatar"><?php #echo substr($session->get_session('fname'), 0,1); ?></span></div>
									<div class="col-11">
										<div class="dashboard-username"><?php #echo $session->get_session('fname') . " " . $session->get_session('lname'); ?></div>
										<div class="dashboard-department">
											<span class="badge badge-dark"><?php #echo ucwords($session->get_session('user_role')); ?> Staff</span>
											<?php #if ($session->get_session('user_role') == 'staff') { ?>
												<span class="badge badge-pill">for</span>
												<?php #123if($session->get_session('permission_students')) { ?><span class="badge badge-pill badge-secondary">Showroom</span> <?php #} ?>
												<?php #if($session->get_session('permission_staff')) { ?><span class="badge badge-pill badge-secondary">Stores</span> <?php #} ?>
												<?php #if($session->get_session('permission_payments')) { ?><span class="badge badge-pill badge-secondary">Accounts</span> <?php #} ?>
												<?php #if($session->get_session('permission_exams')) { ?><span class="badge badge-pill badge-secondary">Admin</span> <?php #} ?>
												<?php #456if($session->get_session('permission_courses')) { ?><span class="badge badge-pill badge-secondary"></span> <?php #} ?>
												<?php #if($session->get_session('permission_finance')) { ?><span class="badge badge-pill badge-secondary"></span> <?php #} ?>
										</div>
                                        <div class="dashboard-username" style="float:right !important"><?php #date_default_timezone_set('Asia/Colombo'); echo date("Y-m-d h:i:s",time()); ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/student-add.png" alt="Image">
								<div class="card-body">
									<a href="student-add.php" class="btn btn-lg btn-dark btn-block">New User</a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/new location.png" alt="Image">
								<div class="card-body">
									<a href="student-search.php" class="btn btn-lg btn-dark btn-block">New Location</a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2">
								<img class="card-img-top p-4" src="assets/images/new department.png" alt="Image">
								<div class="card-body">
									<a href="student-attendance.php" class="btn btn-lg btn-dark btn-block">New Department</a>
								</div>
							</div>
						
							</div>
						</div>
					</div>
				</div>
<?php include_once 'staff-footer.php'; ?>