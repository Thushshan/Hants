<?php 
	include_once 'staff-header.php';
	include_once 'DB_Connection.php';
	
		if(isset($_POST["add"])){
			$userid=$_POST["payid"];
			$month_pay = $_POST["month"];
			$year_pay = $_POST["year"];
			$pay_method = $_POST["pay_method"];
			$allowance= $_POST["allowance"];
			$ot_pay= $_POST["ot"];
			$empepf= $_POST["emp_epf"];
			$emptax= $_POST["emp_tax"];
			$comepf= $_POST["com_epf"];
			$cometf= $_POST["com_etf"];
			$net_sal= $_POST["net_sal"];
			$added_by=$session->get_session('userid');;
			date_default_timezone_set('Asia/Colombo');
			$added_date = date("Y-m-d h:i:s",time());
			$status = "pending";
					
			
			$sql_check_pay = "select * from payroll where staff_id='$userid' and month='$month_pay' and year='$year_pay'";
			$result_check_pay = $conn->query($sql_check_pay);
			
			if($result_check_pay->num_rows>0){
				set_error_msg("<strong>Failed!</strong> Already available in the Database!... Try new record to insert!...");
				header("Location: Finance_Add_Salary.php");	
			}else{
				$sql = "insert into payroll (staff_id,month,year,employee_epf,employee_tax,employer_epf,employer_etf,payment_method,allowance,overtime,net_sal,added_by,added_date,status) values".
				" ('$userid','$month_pay','$year_pay','$empepf','$emptax','$comepf','$cometf','$pay_method','$allowance','$ot_pay','$net_sal','$added_by','$added_date','$status')";
				
						if($conn->query($sql) == true){
							  		set_success_msg("<strong>Success!</strong> New payroll has been successfully inserted!");
									header("Location: Finance_Add_Salary.php");
							  }
						  else{
								  set_error_msg("<strong>Oops!</strong> Something went wrong!...!");
								  header("Location: Finance_Add_Salary.php");
						  }
				
				}
		}
 
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gen_pay'])){
			$user_id = $_POST["user"];
			$payid = $_POST["user"];
			$month = $_POST["month"];
			$year = $_POST["year"];
			$method = $_POST["method"];

function getMonthNo($m){
    if($m=="January"){
        return 1;
    }else if($m=="February"){
        return 2;
    }else if($m=="March"){
        return 3;
    }else if($m=="April"){
        return 4;
    }else if($m=="May"){
        return 5;
    }else if($m=="June"){
        return 6;
    }else if($m=="July"){
        return 7;
    }else if($m=="August"){
        return 8;
    }else if($m=="September"){
        return 9;
    }else if($m=="October"){
        return 10;
    }else if($m=="November"){
        return 11;
    }else if($m=="December"){
        return 12;
    }
} 	
			
			$sql_check_pay = "select * from payroll where staff_id='$user_id' and month='month' and year='year'";
			$result_check_pay = $conn->query($sql_check_pay);
			
			if($result_check_pay->num_rows>0){
				set_error_msg("<strong>Failed!</strong> Already available in the Database!... Try new record to insert!...");
				header("Location: Finance_Add_Salary.php");	
			}
			
			$staff = "select * from users where userid='$user_id'";
			$result_staff = $conn->query($staff);
			$row = $result_staff->fetch_assoc();
			$salary = $row["salary"];
			
			$sql_standards = "select * from emp_pay_standards";
			$result_standards = $conn->query($sql_standards);
			$row_standards = $result_standards->fetch_assoc();
			
			$attendence = "select * from attendance where userid='$user_id' and MONTH(date) = '".getMonthNo($month)."' and YEAR(date) = '$year'";			
			$result_at=mysqli_query($conn,$attendence);
			$row_att=mysqli_num_rows($result_at);
	 	

?>
				<div class="col-md-10">                    
                    
 <div class="container-fluid  m-5">

<form action="Finance_Add_Salary_View.php" method="post" class="form" role="form" autocomplete="off">
<div class="row">
<div class="col-md-2">
					<div class="finance-box">
						<a href="Finance_Closed_Incomes.php" class="btn btn-info btn-lg btn-block"> New </a>
						<hr>
						<a href="Finance_Closed_Incomes.php" class="btn btn-success btn-lg btn-block"> View </a>
					</div>
				</div>
                <div class="col-md-2">
					<div class="finance-box">
						<a href="Finance_Closed_Incomes.php" class="btn btn-danger btn-lg btn-block"> Make Invoice </a>
						<hr>
						<a href="Finance_Closed_Incomes.php" class="btn btn-dark btn-lg btn-block"> Make BRN </a>
                        <hr>
                        <a href="Finance_Closed_Incomes.php" class="btn btn-danger btn-lg btn-block"> Make Receipt </a>
					</div>
				</div>
                <div class="col-md-2">
				</div>
                <div class="col-md-2" style="float:right !important">
					<div class="finance-box">
                    	<h5><center> Print </center></h5>
                        <hr>
						<a href="Finance_Closed_Incomes.php" class="btn btn-danger btn-lg btn-block"> VAT </a>
						<hr>
						<a href="Finance_Closed_Incomes.php" class="btn btn-success btn-lg btn-block"> Non VAT </a>
					</div>
				</div>
                <div class="col-md-2" style="float:right !important">
					<div class="finance-box">
						<a href="Finance_Closed_Incomes.php" class="btn btn-success btn-lg btn-block" style="font-size:50px !important"> POST </a>
					</div>
				</div>
                </div>
                <br />
                <div class="row">
<div class="card-deck">
  					<div class="card" style="height:400px; width:425px;">
                        <div class="card-header">
                            <h4 class="mb-0">Purchase Information</h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> No. </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" name="payid" type="text" value="1001" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Date </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" value="15-11-2018 12:00:01" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label">User ID</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" name="month" type="text" value=" HT1010 " readonly>
                                    </div>
                                </div>
                          </div>
                    </div>
  					<div class="card" style="height:400px; width:425px;">
                        <div class="card-header">
                            <h4 class="mb-0"> Delivery Details </h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Posting Date </label>
                                    <div class="col-lg-8">
                                    	<?php $epf_emp = ($salary*$row_standards["emp_epf"])/100.0 ;?>
                                        <input class="form-control" name="emp_epf" type="text" value=" 15-11-2018 12:02:23 " readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Delivery Date </label>
                                    <div class="col-lg-8">
                                    	<?php $tax_emp = ($salary*$row_standards["emp_tax"])/100.0 ;?>
                                        <input class="form-control" name="emp_tax" type="text" value=" 20-11-2018 00:00:00 " readonly="readonly">
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card" style="height:400px; width:425px;">
                        <div class="card-header">
                            <h4 class="mb-0">Customer Information </h4>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Customer No. </label>
                                    <div class="col-lg-8">
                                    	<?php $all = $row_standards["allowance_per_day"]*$row_att;?>
                                        <input class="form-control" name="allowance" type="text" value=" CUS200" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Customer Name </label>
                                    <div class="col-lg-8">
                                    	<?php $ot = 0*$row_standards["ot_per_hour"]; ?>
                                        <input class="form-control" name="ot" type="text" value=" M.R.Kugan " readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Address </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" value=" 99 1/3, Mattakuliya, Colombo-15 " readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label form-control-label"> Tel No. </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="text" value=" +94 11 2528106 " readonly="readonly">
                                    </div>
                                </div>
                        </div>
                    </div>
                    
</div>
</div> 
</form>            

				
                    
<?php } ?>                
<?php include_once 'staff-footer.php'; ?>