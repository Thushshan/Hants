<?php 
	include_once 'staff-header.php';
	#include_once 'DB_Connection.php';
	  	      
    		/*$sql_tot = "SELECT * FROM incomes";
			$result_tot=mysqli_query($conn,$sql_tot);
			$row_tot=mysqli_num_rows($result_tot);
			
			$sql_max= mysqli_query($conn,"SELECT MAX(id) AS maximum FROM incomes");
			$result_max = mysqli_fetch_assoc($sql_max); 
			$row_max = $result_max['maximum'];
			$row_del = $row_max - $row_tot;
			
			$sql_close = "SELECT * FROM incomes where status='closed'";
			$result_close=mysqli_query($conn,$sql_close);
			$row_close=mysqli_num_rows($result_close);
			
			$sql_pen = "SELECT * FROM incomes where status='pending'";
			$result_pen=mysqli_query($conn,$sql_pen);
			$row_pen=mysqli_num_rows($result_pen);
	
	 */

?>

				<div class="col-md-10">                    
					<div class="tab-content">
						<div class="tab-pane mt-7 show active">
                        	<div class="card bg-light mb-6">
								<div class="card-header"></div>
								<div class="card-body">
							<ul class="ca-menu">
                            
                            
                            
                         <div class="col-md-15">
                            <div class="topnav" align="right" >
                            	
                				<a class="active" href="sales_quotation" </a>
                   						 <input type="text" placeholder="Search..">
                			 </div>   
               			 </div>
                         </div>
                            
                            
                            
                           
                           
                                <div class="col-md-2">
							<div class="card mb-2 p-2" style="background-color:#e2e8e5">
								<div class="card-body">
									<a href="Finance_Expense_Dashboard.php" class="btn btn-lg btn-dark btn-block"> NEW </a>
								</div>
							</div>
						</div>		
									
							
                            <div class="col-md-2">
							<div class="card mb-2 p-2" style="background-color:#e2e8e5">
								<div class="card-body">
									<a href="Finance_Expense_Dashboard.php" class="btn btn-lg btn-dark btn-block"> VIEW </a>
								</div>
							</div>
						</div>		
                            
                           </ul>
                           
                          
                           
                           
                           
                           
                           
                           
                           
                                </div>
                                </div>
                                </div>
						</div>
					</div>
				</div>
                
                
                
                
                
                
                
<?php # include_once 'staff-footer.php'; ?>