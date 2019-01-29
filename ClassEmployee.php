 <?php
/**
*	=============================================
* 	               CLASS STRUCTURE
*	=============================================
*
*	StaffManager 	- Employee management tasks
*	AdminManager	- Admin management tasks
*   BranchManager   - Branch Management tasks
*	SessionManager	- Session management tasks
*	AuthHandler		- User authentication handler 
*	Helpers			- Helper methods
*	Database 		- Database connection
*	=============================================
* 	               CLASS STRUCTURE
*	=============================================
**/

define('USERID', 'userid');
define('USERNAME', 'username');
define('FIRSTNAME', 'firstname');
define('LASTNAME', 'lastname');
define('GENDER', 'gender');
define('DOB', 'dob');
define('MOBILENO', 'mobileno');
define('EMAIL', 'email');
define('NICNO', 'nicno');  
define('LOCATION', 'location');
define('PASSWORD', 'password');
define('REG_DATE', 'reg_date');
define('SALARY', 'salary');
define('STATUS', 'status');
define('RESET_PASSWORD', 'reset_password');
define('RESET_PASSWORD_USER', 'reset_password_user');

define('PERMISSION_STORE', 'permission_store');
define('PERMISSION_ACCOUNTS', 'permission_accounts');
define('PERMISSION_SHOWROOM', 'permission_showroom');
define('PERMISSION_ADMIN', 'permission_admin');
define('PERMISSION_EMPLOYEES', 'permission_employees');


/**
* Branch Management Class
*/

class BranchManager extends Database {

	function __construct() {
		parent::__construct();
	}
	
	public function add_branch($branchname, $deparmenttype, $address, $telno) {

		$sql_user = "INSERT INTO company_branches (name, type, location, phoneno)
				VALUES ('$branchname', '$deparmenttype', '$address', '$telno')";
		if (Database::$DB_CONN->query($sql_user)) {
		    return true;
		} else {
		    echo "Error: " . Database::$DB_CONN->error;
			return false;
		}
	}
	
	public function get_branch_list()	{
		$branch = array();
		$result = Database::$DB_CONN->query("SELECT * FROM company_branches");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($branch, array(
					'id' => $row['id'],
					'name' => $row['name'],
					'type' => $row['type'],
					'location' => $row['location'],
					'phoneno' => $row['phoneno'],
				));
			}
		} else {
			return null;
		}
		return $branch;
	}
	
	public function get_single_branch($branchid) {
		$branch = array();
		$result = Database::$DB_CONN->query("SELECT * FROM company_branches WHERE id='$branchid'
		");
		if ($result->num_rows != 0) {
			while($row = $result->fetch_assoc()) {
				
				array_push($branch, array(
					'id' => $row['id'],
					'name' => $row['name'],
					'type' => $row['type'],
					'location' => $row['location'],					
					'phoneno' => $row['phoneno'],
				));
				break;
			}

		} else {
			return null;
		}
		return $branch;
	}
}

/**
* Staff Management Class
*/

class StaffManager extends Database {

	function __construct() {
		parent::__construct();
	}

	public function get_single_employee($userid) {
		$user = array();
		$result = Database::$DB_CONN->query("
			SELECT id, userid, username, firstname, lastname, gender, dob, mobileno, email, nicno, location, password, reg_date, salary, status, last_seen FROM employees
			WHERE userid='$userid'
		");
		if ($result->num_rows != 0) {
			while($row = $result->fetch_assoc()) {

				$AdminManager = new AdminManager();
				$departments = $AdminManager->get_department_bools_for_user($userid);

				array_push($user, array(
					'userid' => $row['userid'],
					'username' => $row['username'],
					'firstname' => $row['firstname'],
					'lastname' => $row['lastname'],					
					'gender' => $row['gender'],
					'dob' => $row['dob'],
					'mobileno' => $row['mobileno'],
					'email' => $row['email'],
					'nicno' => $row['nicno'],
					'location' => $row['location'],
					'reg_date' => $row['reg_date'],
					'salary' => $row['salary'],
					'status' => $row['status'],
					'departments' => $departments,
				));
				break;
			}

		} else {
			return null;
		}
		return $user;
	}

	public function get_employees($keyword)	{
		$users = array();
		$result = Database::$DB_CONN->query("
			SELECT userid, fname, lname, email, mobile_no, address, dob, reg_date
			FROM users
			WHERE userid LIKE '%$keyword%'
				OR fname LIKE '%$keyword%'
				OR lname LIKE '%$keyword%'
				OR email LIKE '%$keyword%'
				OR mobile_no LIKE '%$keyword%'
				OR address LIKE '%$keyword%'
				OR dob LIKE '%$keyword%'
				OR reg_date LIKE '%$keyword%'
		");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($users, array(
					'userid' => $row['userid'],
					'fname' => $row['fname'],
					'lname' => $row['lname'],
					'email' => $row['email'],
					'mobile_no' => $row['mobile_no'],
					'address' => $row['address'],
					'dob' => $row['dob'],
					'reg_date' => $row['reg_date'],
				));
			}
		} else {
			return null;
		}
		return $users;
	}

	public function get_employee_list()	{
		$users = array();
		$result = Database::$DB_CONN->query("
			SELECT userid, firstname, lastname, email, mobileno, location, dob, reg_date
			FROM employees
		");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($users, array(
					'userid' => $row['userid'],
					'firstname' => $row['firstname'],
					'lastname' => $row['lastname'],
					'email' => $row['email'],
					'mobileno' => $row['mobileno'],
					'address' => $row['location'],
					'dob' => $row['dob'],
					'reg_date' => $row['reg_date'],
				));
			}
		} else {
			return null;
		}
		return $users;
	}

	public function get_employee_list_with_departments()	{
		$users = array();
		$result = Database::$DB_CONN->query("
		SELECT u.userid, u.fname, u.lname, u.email, u.mobile_no, u.address, u.dob, u.reg_date, d.name AS department_name
		FROM users AS u
		LEFT JOIN user_departments AS ud ON ud.userid=u.userid
		LEFT JOIN departments AS d ON d.did=ud.department_id
		");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($users, array(
					'userid' => $row['userid'],
					'fname' => $row['fname'],
					'lname' => $row['lname'],
					'email' => $row['email'],
					'mobile_no' => $row['mobile_no'],
					'address' => $row['address'],
					'dob' => $row['dob'],
					'reg_date' => $row['reg_date'],
					'department' => $row['department_name'],
				));
			}
		} else {
			return null;
		}
		return $users;
	}

	public function add_employee($userid, $uname, $fname, $lname, $gender, $dob, $mobileno, $email, $nicno, $location, $salary) {
 
		$reg_date = date('Y-m-d');
		$password = md5($nicno);
		$status = "active";

		$sql_user = "INSERT INTO employees (userid, username, firstname, lastname, gender, dob, mobileno, email, nicno, location, password, reg_date, salary, status)
				VALUES ('$userid', '$uname', '$fname', '$lname', '$gender', '$dob', '$mobileno', '$email', '$nicno', '$location', '$password', '$reg_date', '$salary', '$status')";
		if (Database::$DB_CONN->query($sql_user)) {
		    return true;
		} else {
		    echo "Error: " . Database::$DB_CONN->error;
			return false;
		}
	}

	public function update_employee($userid, $fname, $lname, $uname, $departments, $dob, $salary, $nic, $mobile_no, $location, $email, $gender) {

		$sql = "UPDATE employees SET username='$uname', firstname='$fname', lastname='$lname', dob='$dob', salary='$salary', nicno='$nic', mobileno='$mobile_no', location='$location', email='$email', gender='$gender' WHERE userid='$userid'";
		if (Database::$DB_CONN->query($sql)) {
			$status_progress = 1;

			if(isset($departments)) {
				$sql_dpt = "INSERT INTO employee_department (userid, departmentid)
						VALUES ('$userid', '$departments') ON DUPLICATE KEY UPDATE departmentid='$departments'";
				if (Database::$DB_CONN->query($sql_dpt)) {
				    $status_progress = 1;
				} else {
				    echo "Error: " . Database::$DB_CONN->error;
					$status_progress = 0;
				}
			}

		} else {
			$status_progress = 0;
			echo "Error updating record: " . Database::$DB_CONN->error;
		}

		return $status_progress;
	}

	public function update_employee_profile($userid, $mobile_no, $address, $email, $password) {

		$sql = "UPDATE employees SET mobileno='$mobile_no', location='$address', email='$email' WHERE userid='$userid'";
		if (Database::$DB_CONN->query($sql)) {
			$status_progress = 1;
		} else {
			$status_progress = 0;
			echo "Error updating record: " . Database::$DB_CONN->error;
		}

		if ($password != '') {
			$password = md5($password);
			$sql = "UPDATE employees SET password='$password' WHERE userid='$userid'";
			if (Database::$DB_CONN->query($sql)) {
				$status_progress = 1;
			} else {
				$status_progress = 0;
				echo "Error updating record: " . Database::$DB_CONN->error;
			}
		}

		return $status_progress;
	}

	public function remove_employee($userid) {

		$sql = "DELETE FROM users WHERE userid='$userid'";
		$stmt = Database::$DB_CONN->prepare($sql);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			return true;
		} else {
			echo "Error deleting record: " . Database::$DB_CONN->error;
			return false;
		}
	}

	public function mark_attendance($userid) {

		$date = date("Y-m-d");
		$time = date("H:i:s");

		$sql = "INSERT INTO attendance (userid, date, time)
				VALUES ('$userid', '$date', '$time')";
		if (Database::$DB_CONN->query($sql)) {
		    return true;
		} else {
		    echo "Error: " . Database::$DB_CONN->error;
			return false;
		}
	}

	public function get_attendances($keyword)	{
		$users = array();
		$result = Database::$DB_CONN->query("
			SELECT users.userid, users.fname, users.lname, users.email, users.mobile_no, users.address, attendance.date, attendance.time, CURRENT_DATE as curr_date
			FROM users
			LEFT JOIN attendance
			ON users.userid=attendance.userid
			WHERE users.userid LIKE '%$keyword%'
				OR users.fname LIKE '%$keyword%'
				OR users.lname LIKE '%$keyword%'
				OR users.email LIKE '%$keyword%'
				OR users.mobile_no LIKE '%$keyword%'
				OR users.address LIKE '%$keyword%'
				OR attendance.date LIKE '%$keyword%'
				OR attendance.time LIKE '%$keyword%'
			ORDER BY attendance.date DESC");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($users, array(
					'userid' => $row['userid'],
					'fname' => $row['fname'],
					'lname' => $row['lname'],
					'email' => $row['email'],
					'mobile_no' => $row['mobile_no'],
					'address' => $row['address'],
					'date' => $row['date'],
					'time' => $row['time'],
					'today' => $row['curr_date'],
				));
			}
		} else {
			return null;
		}
		return $users;
	}

	public function get_attendance_list()	{
		$users = array();
		$unique_users = array();
		$result = Database::$DB_CONN->query("
			SELECT users.userid, users.fname, users.lname, users.email, users.mobile_no, users.address, attendance.date, attendance.time, CURRENT_DATE as curr_date
				FROM users
				LEFT JOIN attendance
				ON users.userid=attendance.userid
				ORDER BY attendance.date DESC");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if (!is_numeric(array_search($row['userid'], $unique_users))) {
					array_push($unique_users, $row['userid']);
				} else {
					continue;
				}
				array_push($users, array(
					'userid' => $row['userid'],
					'fname' => $row['fname'],
					'lname' => $row['lname'],
					'email' => $row['email'],
					'mobile_no' => $row['mobile_no'],
					'address' => $row['address'],
					'date' => $row['date'],
					'time' => $row['time'],
					'today' => $row['curr_date'],
				));
			}
		} else {
			return null;
		}
		return array_reverse($users);
	}
}



/**
* Admin Management Class
*/
class AdminManager extends Database {

	public $session;

	function __construct() {
		parent::__construct();
		$this->session = new SessionManager();
	}

	public function set_permissions($userid) {
		// Reset permissions 
		$this->session->set_session(PERMISSION_STORE, '0');
		$this->session->set_session(PERMISSION_ACCOUNTS, '0');
		$this->session->set_session(PERMISSION_SHOWROOM, '0');
		$this->session->set_session(PERMISSION_ADMIN, '0');
		$this->session->set_session(PERMISSION_EMPLOYEES, '0');

		$dept_res = Database::$DB_CONN->query("
			SELECT userid, employee, store, accounts, showroom, admin
			FROM employee_department
			LEFT JOIN departments
			ON departments.did=employee_department .departmentid
			WHERE userid='$userid'
		");
		while($row = $dept_res->fetch_assoc()) {
			($row['employee']) ? $this->session->set_session(PERMISSION_EMPLOYEES, '1') : null;
			($row['store']) ? $this->session->set_session(PERMISSION_STORE, '1') : null;
			($row['accounts']) ? $this->session->set_session(PERMISSION_ACCOUNTS, '1') : null;
			($row['showroom']) ? $this->session->set_session(PERMISSION_SHOWROOM, '1') : null;
			($row['admin']) ? $this->session->set_session(PERMISSION_ADMIN, '1') : null;
		}
	}

	public function get_departments_list() {
		$departments = array();
		$result = Database::$DB_CONN->query("SELECT * FROM departments");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['name'] == 'Administration') { continue; }
				array_push($departments, array(
					'did' => $row['did'],
					'name' => $row['name'],
					'employee' => $row['employee'],
					'store' => $row['store'],
					'accounts' => $row['accounts'],
					'showroom' => $row['showroom'],
					'admin' => $row['admin'],
				));
			}
		} else {
			return null;
		}
		return $departments;
	}

	// Returns true if an user has access to a department
	public function get_department_bools_for_user($userid) {
		$departments = array();
		$result = Database::$DB_CONN->query("
			SELECT did, name, userid
			FROM departments
			LEFT JOIN employee_department ON departments.did=employee_department.departmentid
		");
		if ($result->num_rows != 0) {
			while($row = $result->fetch_assoc()) {
				array_push($departments, array(
					'did' => $row['did'],
					'name' => $row['name'],
					'status' => ($row['userid'] == $userid)
				));
			}
			return $departments;
		} else {
			return null;
		}
	}

	public function get_departments($keyword) {
		$departments = array();
		$result = Database::$DB_CONN->query("SELECT * FROM departments WHERE name LIKE '%$keyword%'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['name'] == 'Admin') { continue; }
				array_push($departments, array(
					'did' => $row['did'],
					'name' => $row['name'],
					'employee' => $row['employee'],
					'store' => $row['store'],
					'accounts' => $row['accounts'],
					'showroom' => $row['showroom'],
					'admin' => $row['admin'],
				));
			}
		} else {
			return null;
		}
		return $departments;
	}

	public function create_department($name) {
		$sql_user = "
			INSERT INTO departments (name, employee, store, accounts, showroom, admin)
			VALUES ('$name', '0', '0', '0', '0', '0')";
		if (Database::$DB_CONN->query($sql_user)) {
		    return true;
		} else {
		    echo "Error: " . Database::$DB_CONN->error;
			return false;
		}
	}

	public function update_department($uid, $emp, $sto, $acc, $sho, $adm) {
		$sql = "UPDATE departments SET employee=$emp, store=$sto, accounts=$acc, showroom=$sho, admin=$adm WHERE did=$uid";
		if (Database::$DB_CONN->query($sql)) {

			$AdminManager = new AdminManager();
			$userid = $this->session->get_session('userid');
			$AdminManager->set_permissions($userid);

			return true;
		} else {
			echo "Error updating record: " . Database::$DB_CONN->error;
			return false;
		}
	}

	public function delete_department($did) {
		$sql = "DELETE FROM departments WHERE did=$did";
		if (Database::$DB_CONN->query($sql)) {
			return true;
		} else {
			echo "Error deleting record: " . Database::$DB_CONN->error;
			return false;
		}
	}
	

}

/**
* Helpers Class
*/
class Helpers extends Database {

	function __construct() {
		parent::__construct();
	}

	public function generate_userid() {
		$year = substr(date("Y"),2);
		$result = Database::$DB_CONN->query("SELECT MAX(id) AS maximum FROM employees");
		$max = $result->fetch_assoc();
		$id = $max['maximum']+1;
		
		if($id<10)
			return "HT".$year."0".$id;
		else
			return "HT".$year.$id;
		
	}

	public function get_total_employees() {

		$result = Database::$DB_CONN->query("
			SELECT count(*) AS cnt
			FROM users
		");
		if ($result->num_rows != 0) {
			while($row = $result->fetch_assoc()) {
				return $row['cnt'];
			}
		} else {
			return 0;
		}
	}

	public function get_total_departments() {

		$result = Database::$DB_CONN->query("
			SELECT count(*) AS cnt
			FROM departments
		");
		if ($result->num_rows != 0) {
			while($row = $result->fetch_assoc()) {
				return $row['cnt'];
			}
		} else {
			return 0;
		}
	}

	public function get_today_attendance() {

		$date = date('Y-m-d');
		$result = Database::$DB_CONN->query("
			SELECT count(*) AS cnt
			FROM attendance
			WHERE date='$date'
		");
		if ($result->num_rows != 0) {
			while($row = $result->fetch_assoc()) {
				return $row['cnt'];
			}
		} else {
			return 0;
		}
	}

	public function get_total_students() {

		$result = Database::$DB_CONN->query("
			SELECT count(*) AS cnt
			FROM students
		");
		if ($result->num_rows != 0) {
			while($row = $result->fetch_assoc()) {
				return $row['cnt'];
			}
		} else {
			return 0;
		}
	}
	

}

/**
* Session Management Class
*/
class SessionManager {

	function __construct() {
		if (!isset($_SESSION)) {
			session_start();
		}
	}

	public function set_session($name, $value) {
		$_SESSION[$name] = $value;
	}

	public function unset_session($name) {
		$_SESSION[$name] = null;
	}

	public function get_session($name) {
		if(isset($_SESSION[$name])) {
			return $_SESSION[$name];
		} else {
			return null;
		}
	}

	public function destroy_session() {
		session_destroy();
		$_SESSION = array();
	} 
}

/**
* Auth Handler
*/
class AuthHandler extends Database {

	public $session;

	function __construct() {
		parent::__construct();
		$this->session = new SessionManager();
	}

	public function auth_status() {
		return (!is_null($this->session->get_session(USERID)));
	}
	
	public function reset_password($userid, $password) {
		
		date_default_timezone_set('Asia/Colombo');
		$updatedate = date("Y-m-d",time());
		$status = "active";
		$status_progress = 0;

		if ($password != '') {
			$password = md5($password);
			$sql = "UPDATE employees SET password='$password', password_date='$updatedate', status='$status' WHERE userid='$userid'";
			if (Database::$DB_CONN->query($sql)) {
				$status_progress = 1;
			} else {
				$status_progress = 0;
				echo "Error updating record: " . Database::$DB_CONN->error;
			}
		}

		return $status_progress;
	}
	
	public function check_login_credentials_username($username, $password){
		
		$password = md5($password);
		$result = Database::$DB_CONN->query("SELECT * FROM employees WHERE username = '$username' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()){
				$this->session->set_session(RESET_PASSWORD_USER,$row['userid']);
				break;
			}
			return true;
		}else{
			return false;
		}
	}
	
	public function check_login_credentials_userid($userid, $password){
		
		$password = md5($password);
		$result =  Database::$DB_CONN->query("SELECT * FROM employees WHERE userid = '$userid' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()){
				$this->session->set_session(RESET_PASSWORD_USER, $row['userid']);
				break;
			}
			return true;
		}else{
			return false;
		}
	}
	
	public function check_login_credentials_email($email, $password){
		
		$password = md5($password);
		$result = Database::$DB_CONN->query("SELECT * FROM employees WHERE email = '$email' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()){
				$this->session->set_session(RESET_PASSWORD_USER, $row['userid']);
				break;
			}
			return true;
		}else{
			return false;
		}
	}
	
	public function check_userstatus_username($username, $password){
		
		$password = md5($password);
		$status = null;
		$result = Database::$DB_CONN->query("SELECT * FROM employees WHERE username = '$username' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$status = $row['status'];
				break;
			}
			return $status;
		}else{
			return null;
		}
	}
	
	public function check_userstatus_userid($username, $password){
		
		$password = md5($password);
		$status = null;
		$result = Database::$DB_CONN->query("SELECT * FROM employees WHERE userid = '$userid' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$status = $row['status'];
				break;
			}
			return $status;
		}else{
			return null;
		}
	}
	
	public function check_userstatus_email($email, $password){
		
		$password = md5($password);
		$status = null;
		$result = Database::$DB_CONN->query("SELECT * FROM employees WHERE email = '$email' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$status = $row['status'];
				break;
			}
			return $status;
		}else{
			return null;
		}
	}
	
	public function check_password_expiry_username($username, $password){
		
		$password = md5($password);
		
		date_default_timezone_set('Asia/Colombo');
		$current_date = strtotime(date("Y-m-d",time()));
		
		$date_diff = null;
		$date = null;
		
		$result = Database::$DB_CONN->query("SELECT * FROM employees WHERE username = '$username' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			
			while($row = $result->fetch_assoc()) {
				$date = strtotime($row['password_date']);
				break;
			}
			
			$date_diff = floor(($current_date - $date)/(60*60*24));
			
			if($date_diff <= 14){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
	
	public function check_password_expiry_userid($userid, $password){
		
		$password = md5($password);
		
		date_default_timezone_set('Asia/Colombo');
		$current_date = strtotime(date("Y-m-d",time()));
		
		$date_diff = null;
		$date = null;
		
		$result = Database::$DB_CONN->query("SELECT * FROM employees WHERE userid = '$userid' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			
			while($row = $result->fetch_assoc()) {
				$date = strtotime($row['password_date']);
				break;
			}
			
			$date_diff = floor(($current_date - $date)/(60*60*24));
			
			if($date_diff <= 14){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
	
	public function check_password_expiry_email($email, $password){
		
		$password = md5($password);
		
		date_default_timezone_set('Asia/Colombo');
		$current_date = strtotime(date("Y-m-d",time()));
		
		$date_diff = null;
		$date = null;
		
		$result = Database::$DB_CONN->query("SELECT * FROM employees WHERE email = '$email' AND password = '$password'");
		
		if ($result->num_rows == 1) {
			
			while($row = $result->fetch_assoc()) {
				$date = strtotime($row['password_date']);
				break;
			}
			
			$date_diff = floor(($current_date - $date)/(60*60*24));
			
			if($date_diff <= 14){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}
	
	public function login_with_username($username, $password) {
		$password = md5($password);
		$user_id = null;
		$result = Database::$DB_CONN->query(
					"SELECT * FROM employees
					WHERE username = '$username'
					AND password = '$password'"
				);

		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$user_id = $row['userid'];
				$this->session->set_session(USERID, $row['userid']);
				$this->session->set_session(USERNAME, $row['username']);
				$this->session->set_session(FIRSTNAME, $row['firstname']);
				$this->session->set_session(LASTNAME, $row['lastname']);
				$this->session->set_session(GENDER, $row['gender']);
				$this->session->set_session(DOB, $row['dob']);
		    	$this->session->set_session(MOBILENO, $row['mobileno']);
				$this->session->set_session(EMAIL, $row['email']);
				$this->session->set_session(NICNO, $row['nicno']);
				$this->session->set_session(LOCATION, $row['location']);
				$this->session->set_session(PASSWORD, $row['password']);
				$this->session->set_session(REG_DATE, $row['reg_date']);
				$this->session->set_session(SALARY, $row['salary']);
				$this->session->set_session(STATUS, $row['status']);
				$this->session->set_session(LAST_SEEN, $row['last_seen']);
				break;
			}

			$AdminManager = new AdminManager();
			$AdminManager->set_permissions($user_id);

			return true;
		} else {
			return false;
		}
		return false;
	}
	
	public function login_with_userid($userid, $password) {
		$password = md5($password);
		$user_id = null;
		$result = Database::$DB_CONN->query(
					"SELECT id, userid, username, firstname, lastname, gender, dob, mobileno, email, nicno, location, password, reg_date, salary, status, last_seen FROM employees
					WHERE userid = '$userid'
					AND password = '$password'"
				);

		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$user_id = $row['userid'];
				$this->session->set_session(USERID, $row['userid']);
				$this->session->set_session(USERNAME, $row['username']);
				$this->session->set_session(FIRSTNAME, $row['firstname']);
				$this->session->set_session(LASTNAME, $row['lastname']);
				$this->session->set_session(GENDER, $row['gender']);
				$this->session->set_session(DOB, $row['dob']);
				$this->session->set_session(MOBILENO, $row['mobileno']); 
				$this->session->set_session(EMAIL, $row['email']);
				$this->session->set_session(NICNO, $row['nicno']);
				$this->session->set_session(LOCATION, $row['location']);
				$this->session->set_session(PASSWORD, $row['password']);
				$this->session->set_session(REG_DATE, $row['reg_date']);
				$this->session->set_session(SALARY, $row['salary']);
				$this->session->set_session(STATUS, $row['status']);
				$this->session->set_session(LAST_SEEN, $row['last_seen']);
				break;
			}

			$AdminManager = new AdminManager();
			$AdminManager->set_permissions($user_id);

			return true;
		} else {
			return false;
		}
		return false;
	}
	
	public function login_with_email($email, $password) {
		$password = md5($password);
		$user_id = null;
		$result = Database::$DB_CONN->query("SELECT *  FROM employees WHERE email = '$email' AND password = '$password'");

		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$user_id = $row['userid'];
				$this->session->set_session(USERID, $row['userid']);
				$this->session->set_session(USERNAME, $row['username']);
				$this->session->set_session(FIRSTNAME, $row['firstname']);
				$this->session->set_session(LASTNAME, $row['lastname']);
				$this->session->set_session(GENDER, $row['gender']);
				$this->session->set_session(DOB, $row['dob']);
				$this->session->set_session(MOBILENO, $row['mobileno']); 
				$this->session->set_session(EMAIL, $row['email']);
				$this->session->set_session(NICNO, $row['nicno']);
				$this->session->set_session(LOCATION, $row['location']);
				$this->session->set_session(PASSWORD, $row['password']);
				$this->session->set_session(REG_DATE, $row['reg_date']);
				$this->session->set_session(SALARY, $row['salary']);
				$this->session->set_session(STATUS, $row['status']);
				break;
			}

			$AdminManager = new AdminManager();
			$AdminManager->set_permissions($user_id);

			return true;
		} else {
			return false;
		}
		return false;
	}

	public function logout() {
		// User session removal
		$this->session->unset_session(USERID);
		$this->session->unset_session(USERNAME);
		$this->session->unset_session(FIRSTNAME);
		$this->session->unset_session(LASTNAME);
		$this->session->unset_session(GENDER);
		$this->session->unset_session(DOB);
		$this->session->unset_session(MOBILENO); 
		$this->session->unset_session(EMAIL);
		$this->session->unset_session(NICNO);
		$this->session->unset_session(LOCATION);
		$this->session->unset_session(PASSWORD);
		$this->session->unset_session(REG_DATE);
		$this->session->unset_session(SALARY);
		$this->session->unset_session(STATUS);
		$this->session->unset_session(LAST_SEEN);

		// User permission removal
		$this->session->unset_session(PERMISSION_STORE);
		$this->session->unset_session(PERMISSION_ACCOUNTS);
		$this->session->unset_session(PERMISSION_SHOWROOM);
		$this->session->unset_session(PERMISSION_ADMIN);
		$this->session->unset_session(PERMISSION_EMPLOYEES);

		$this->session->destroy_session();
	}
}

/**
* Database Connection Class
*/
class Database {

	public static $DB_CONN;
	private $DB_USER = 'root';
	private $DB_PASS = '';
	private $DB_NAME = 'hants';
	private $DB_HOST = 'localhost';
	private $DB_PORT = '3306';
	private $DB_CONN_STATUS = false;

	public function __construct() {
		if(!isset(self::$DB_CONN)) {
			self::$DB_CONN = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME, $this->DB_PORT);
			if(self::$DB_CONN->connect_error) {
				die("Database connection error: " . self::$DB_CONN->connect_error);
			} else {
				$this->DB_CONN_STATUS = true;
			}
			$this->DB_CONN_STATUS = true;
		}
	}

	public function db_conn_status() {
		return $this->DB_CONN_STATUS;
	}
}
?>
