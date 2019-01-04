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
					<?php #$Helpers = new Helpers(); ?>
					<?php #if($session->get_session('permission_employees')) { ?>
						<div class="row">
							<div class="col-md-12">
								<div class="card bg-light mb-3">
									<div class="card-header">Overview</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-3">
												<div class="card text-white bg-secondary mb-3">
													<div class="card-header"> Pending Sales Orders </div>
													<div class="card-body">
														<h3 class="card-title"><?php #echo $Helpers->get_total_employees(); ?></h3>
														<p class="card-text"></p>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="card text-white bg-success mb-3">
													<div class="card-header"> Pending Sales Invoices </div>
													<div class="card-body">
														<h3 class="card-title"><?php #echo $Helpers->get_total_departments(); ?></h3>
														<p class="card-text"></p>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="card text-white bg-info mb-3">
													<div class="card-header"> Pending Branch Request Notes </div>
													<div class="card-body">
														<h3 class="card-title"><?php #echo $Helpers->get_today_attendance(); ?></h3>
														<p class="card-text"></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="card bg-light mb-3">
									<div class="card-header">Sales Management</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales quotation.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Income_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Quotations </a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales order.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Expense_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Orders </a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales invoices.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Payroll_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Invoices </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/branch request note.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Leave_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Branch Request Notes </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3" >
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales return order.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Bank_Accounts_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Return Orders </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales receipts.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Payroll_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Reciepts </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/branch request note.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Leave_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Credit Memos </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3" >
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/reports2.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Bank_Accounts_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Reports </a>
								</div>
							</div>
						</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                        
                        <div class="row">
							<div class="col-md-12">
								<div class="card bg-light mb-3">
									<div class="card-body">
										<div class="row">
											<div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/customer list.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Income_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Customer List </a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/item list.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Expense_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Item List </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/posted documents.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Payroll_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Posted Documents </a>
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
