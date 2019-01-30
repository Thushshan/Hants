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
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales-quotes.png" alt="Image">
								<div class="card-body">
									<a href="sales quotation.php" class="btn btn-lg btn-dark btn-block"> Sales Quotations </a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales-order.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Expense_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Orders </a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales-invoice.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Payroll_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Invoices </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/branch-request-note.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Leave_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Branch Request Notes </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3" >
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales-return.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Bank_Accounts_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Return Orders </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/sales-receipts.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Payroll_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Sales Reciepts </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/credit-memo.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Leave_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Credit Memos </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3" >
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/reports.png" alt="Image">
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
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/customer-list.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Income_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Customer List </a>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/item-list.png" alt="Image">
								<div class="card-body">
									<a href="Finance_Expense_Dashboard.php" class="btn btn-lg btn-dark btn-block"> Item List </a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card mb-4 p-2" style="background-color:#e2e8e5">
								<img height="270" width="130" class="card-img-top p-4" src="assets/images/posted-documents.png" alt="Image">
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
