<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		
		extract($_POST);		
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_SESSION['login_type'] != 1){
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				return 2 ;
				exit;
			}
				return 1;
		}else{
			return 3;
		}
}
	function login2(){
		
			extract($_POST);
			if(isset($email))
				$username = $email;
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_SESSION['login_alumnus_id'] > 0){
				$bio = $this->db->query("SELECT * FROM alumnus_bio where id = ".$_SESSION['login_alumnus_id']);
				if($bio->num_rows > 0){
					foreach ($bio->fetch_array() as $key => $value) {
						if($key != 'passwors' && !is_numeric($key))
							$_SESSION['bio'][$key] = $value;
					}
				}
			}
			if($_SESSION['bio']['status'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
				return 1;
		}else{
			return 3;
		}
	}

	function login3(){
		
		extract($_POST);
		if(isset($email))
			$username = $email;
	$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
	if($qry->num_rows > 0){
		foreach ($qry->fetch_array() as $key => $value) {
			if($key != 'passwors' && !is_numeric($key))
				$_SESSION['login_'.$key] = $value;
		}
		if($_SESSION['login_student_id'] > 0){
			$bio = $this->db->query("SELECT * FROM student_bio where id = ".$_SESSION['login_student_id']);
			if($bio->num_rows > 0){
				foreach ($bio->fetch_array() as $key => $value) {
					if($key != 'passwors' && !is_numeric($key))
						$_SESSION['bio'][$key] = $value;
				}
			}
		}
		if($_SESSION['bio']['status'] != 1){
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				return 2 ;
				exit;
			}
			return 1;
	}else{
		return 3;
	}
}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST); // Extract form fields into variables
	
		// Start building the data for the users table
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
	
		// If password is provided, hash and add to data
		if(!empty($password)) {
			$data .= ", password = '".md5($password)."' ";
		}
	
		// Set the user type (Admin, Student, or Alumnus)
		$data .= ", type = '$type' ";
	
		// Check if the username already exists (for all users except the current one being edited)
		$chk = $this->db->query("SELECT * FROM users WHERE username = '$username' AND id != '$id' ")->num_rows;
		if($chk > 0) {
			return 2; // Username already exists
			exit;
		}
	
		// Set the establishment_id if necessary (for Admin users)
		if($type == 1) {
			$establishment_id = 0; // Admin users have establishment_id as 0
		} else {
			// Set to null or a specific value if needed for students and alumni
			$establishment_id = isset($establishment_id) ? $establishment_id : null;
		}
		$data .= ", establishment_id = '$establishment_id' ";
	
		// If the ID is empty, it's a new user, so we insert the user data
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users SET ".$data);
			$user_id = $this->db->insert_id; // Get the newly created user's ID
		} else {
			// If ID exists, we update the existing user's data
			$save = $this->db->query("UPDATE users SET ".$data." WHERE id = ".$id);
			$user_id = $id; // Use the existing user ID
		}
	
		// Now handle the bio data for students and alumni
		if($save) {
			// If the user is a student (type 2), insert/update student_bio
			if($type == 2) {
				// Ensure the student_bio table has a user_id column and update accordingly
				$student_bio_data = [
					'user_id' => $user_id,
					'firstname' => $firstname,
					'middlename' => $middlename,
					'lastname' => $lastname,
					'gender' => $gender,
					'cohort' => $cohort,
					'course_id' => $course_id,
					'email' => $email,
					's_id' => $student_id,  // Assuming student_id is a POST variable
					'status' => $status
				];
	
				// Check if the student already has a bio entry; if not, create it
				$existing_bio = $this->db->query("SELECT * FROM student_bio WHERE user_id = '$user_id'");
				if($existing_bio->num_rows == 0) {
					$this->db->query("INSERT INTO student_bio (user_id, firstname, middlename, lastname, gender, cohort, course_id, email, s_id, status) 
					VALUES ('$user_id', '$firstname', '$middlename', '$lastname', '$gender', '$cohort', '$course_id', '$email', '$student_id', '$status')");
				} else {
					$this->db->query("UPDATE student_bio SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', 
					gender = '$gender', cohort = '$cohort', course_id = '$course_id', email = '$email', s_id = '$student_id', status = '$status' 
					WHERE user_id = '$user_id'");
				}
			}
	
			// If the user is an alumnus (type 3), insert/update alumnus_bio
			if($type == 3) {
				// Ensure the alumnus_bio table has a user_id column and update accordingly
				$alumnus_bio_data = [
					'user_id' => $user_id,
					'firstname' => $firstname,
					'middlename' => $middlename,
					'lastname' => $lastname,
					'gender' => $gender,
					'batch' => $batch,
					'course_id' => $course_id,
					'email' => $email,
					'connected_to' => $connected_to,
					'status' => $status
				];
	
				// Check if the alumnus already has a bio entry; if not, create it
				$existing_bio = $this->db->query("SELECT * FROM alumnus_bio WHERE user_id = '$user_id'");
				if($existing_bio->num_rows == 0) {
					$this->db->query("INSERT INTO alumnus_bio (user_id, firstname, middlename, lastname, gender, batch, course_id, email, connected_to, status) 
					VALUES ('$user_id', '$firstname', '$middlename', '$lastname', '$gender', '$batch', '$course_id', '$email', '$connected_to', '$status')");
				} else {
					$this->db->query("UPDATE alumnus_bio SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', 
					gender = '$gender', batch = '$batch', course_id = '$course_id', email = '$email', connected_to = '$connected_to', status = '$status' 
					WHERE user_id = '$user_id'");
				}
			}
	
			return 1; // Success
		}
	
		return 0; // Failure
	}
	
	
	function delete_user() {
		extract($_POST);
	
		// Fetch the user data based on the provided ID
		$query = $this->db->query("SELECT alumnus_id, student_id FROM users WHERE id = $id");
	
		if ($query->num_rows > 0) {
			$user = $query->fetch_assoc();
	
			// Check if the user is an alumnus and delete the corresponding record
			if (!empty($user['alumnus_id'])) {
				$this->db->query("DELETE FROM alumnus_bio WHERE id = " . $user['alumnus_id']);
			}
	
			// Check if the user is a student and delete the corresponding record
			if (!empty($user['student_id'])) {
				$this->db->query("DELETE FROM student_bio WHERE id = " . $user['student_id']);
			}
	
			// Finally, delete the user from the users table
			$delete = $this->db->query("DELETE FROM users WHERE id = $id");
	
			if ($delete) {
				return 1; // Successfully deleted
			} else {
				return 0; // Failed to delete user
			}
		} else {
			return 0; // User not found
		}
	}
	
	function delete_alumni(){
		extract($_POST);
	
		// Begin a database transaction
		$this->db->begin_transaction();
	
		try {
			// Delete the alumnus from the `alumnus_bio` table
			$delete_alumni = $this->db->query("DELETE FROM alumnus_bio WHERE id = ".$id);
	
			// Delete the corresponding user from the `users` table
			$delete_user = $this->db->query("DELETE FROM users WHERE alumnus_id = ".$id);
	
			if ($delete_alumni && $delete_user) {
				// Commit the transaction if both queries are successful
				$this->db->commit();
				return 1;
			} else {
				// Rollback if any query fails
				$this->db->rollback();
				return 0;
			}
		} catch (Exception $e) {
			// Rollback in case of any exception
			$this->db->rollback();
			return 0;
		}
	}
	
	function delete_student(){
		extract($_POST);
	
		// Begin a database transaction
		$this->db->begin_transaction();
	
		try {
			// Delete the alumnus from the `alumnus_bio` table
			$delete_student = $this->db->query("DELETE FROM student_bio WHERE id = ".$id);
	
			// Delete the corresponding user from the `users` table
			$delete_user = $this->db->query("DELETE FROM users WHERE student_id = ".$id);
	
			if ($delete_student && $delete_user) {
				// Commit the transaction if both queries are successful
				$this->db->commit();
				return 1;
			} else {
				// Rollback if any query fails
				$this->db->rollback();
				return 0;
			}
		} catch (Exception $e) {
			// Rollback in case of any exception
			$this->db->rollback();
			return 0;
		}
	}
	function signup(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = 3 "; // Set type = 3 for alumni
	
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$uid = $this->db->insert_id;
			$data = '';
			foreach($_POST as $k => $v){
				if($k == 'password' || $k == 'type') // Skip password and type
					continue;
				if(empty($data) && !is_numeric($k))
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if($_FILES['img']['tmp_name'] != ''){
				$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
				$data .= ", avatar = '$fname' ";
			}
			$save_alumni = $this->db->query("INSERT INTO alumnus_bio set $data ");
			if($data){
				$aid = $this->db->insert_id;
				$this->db->query("UPDATE users set alumnus_id = $aid where id = $uid ");
				$login = $this->login2();
				if($login)
					return 1;
			}
		}
	}
	
	function s_signup(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = 2 "; // Set type = 2 for students
	
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$uid = $this->db->insert_id;
			$data = '';
			foreach($_POST as $k => $v){
				if($k == 'password' || $k == 'type') // Skip password and type
					continue;
				if(empty($data) && !is_numeric($k))
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			$save_student = $this->db->query("INSERT INTO student_bio set $data ");
			if($data){
				$aid = $this->db->insert_id;
				$this->db->query("UPDATE users set student_id = $aid where id = $uid ");
				$login = $this->login3();
				if($login)
					return 1;
			}
		}
	}
	

	function update_account() {
		extract($_POST);
	
		// Sanitize inputs to prevent SQL injection
		$firstname = $this->db->real_escape_string($firstname);
		$lastname = $this->db->real_escape_string($lastname);
		$email = $this->db->real_escape_string($email);
	
		// Construct data for the 'users' table
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
	
		if (!empty($password)) {
			// Hash the password using MD5 (to match the login function)
			$hashed_password = md5($password);
			$data .= ", password = '$hashed_password' ";
		}
	
		// Check if email already exists in 'users' table (excluding the current user)
		$chk_query = "SELECT * FROM users WHERE username = '$email' AND id != '{$_SESSION['login_id']}'";
		$chk = $this->db->query($chk_query);
		if ($chk->num_rows > 0) {
			return 2; // Email already exists
		}
	
		// Update 'users' table (if necessary)
		$update_user_query = "UPDATE users SET $data WHERE id = '{$_SESSION['login_id']}'";
		$save = $this->db->query($update_user_query);
		if (!$save) {
			return 0; // Failed to update user data
		}
	
		// Construct data for 'alumnus_bio' table
		$alumnus_data = [];
		foreach ($_POST as $k => $v) {
			// Skip password and any numeric keys
			if ($k == 'password' || is_numeric($k)) continue;
			$alumnus_data[] = "$k = '" . $this->db->real_escape_string($v) . "'";
		}
	
		// Handle file upload for 'avatar'
		if (!empty($_FILES['img']['tmp_name']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
			$fname = strtotime(date('Y-m-d H:i:s')) . '_' . basename($_FILES['img']['name']);
			$target_path = 'assets/uploads/' . $fname;
			if (move_uploaded_file($_FILES['img']['tmp_name'], $target_path)) {
				$alumnus_data[] = "avatar = '$fname'";
			}
		}
	
		// Update 'alumnus_bio' table with the new data
		$data_str = implode(', ', $alumnus_data);
		$update_alumnus_query = "UPDATE alumnus_bio SET $data_str WHERE id = '{$_SESSION['bio']['id']}'";
		$save_alumni = $this->db->query($update_alumnus_query);
		if (!$save_alumni) {
			return 0; // Failed to update alumni bio
		}
	
		// If everything is successful, return 1
		return 1; // Success
	}
	
	
	

	function s_update_account() {
		extract($_POST);
	
		// Sanitize inputs to prevent SQL injection
		$firstname = $this->db->real_escape_string($firstname);
		$middlename = isset($middlename) ? $this->db->real_escape_string($middlename) : '';
		$lastname = $this->db->real_escape_string($lastname);
		$gender = $this->db->real_escape_string($gender);
		$cohort = $this->db->real_escape_string($cohort);
		$course_id = $this->db->real_escape_string($course_id);
		$s_id = $this->db->real_escape_string($s_id);
		$email = $this->db->real_escape_string($email);
	
		// Construct data for the 'users' table
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
	
		if (!empty($password)) {
			// Hash the password using MD5 (to match the login function)
			$hashed_password = md5($password);
			$data .= ", password = '$hashed_password' ";
		}
	
		// Check if email already exists in 'users' table (excluding the current user)
		$chk_query = "SELECT * FROM users WHERE username = '$email' AND id != '{$_SESSION['login_id']}'";
		$chk = $this->db->query($chk_query);
		if ($chk->num_rows > 0) {
			return 2; // Email already exists
		}
	
		// Update 'users' table
		$update_user_query = "UPDATE users SET $data WHERE id = '{$_SESSION['login_id']}'";
		$save = $this->db->query($update_user_query);
		if (!$save) {
			return 0; // Failed to update user data
		}
	
		// Construct data for 'student_bio' table
		$student_data = [
			"firstname = '$firstname'",
			"middlename = '$middlename'",
			"lastname = '$lastname'",
			"gender = '$gender'",
			"cohort = '$cohort'",
			"course_id = '$course_id'",
			"email = '$email'",
			"s_id = '$s_id'"
		];
	
		// Update 'student_bio' table with the new data
		$data_str = implode(', ', $student_data);
		$update_student_query = "UPDATE student_bio SET $data_str WHERE id = '{$_SESSION['bio']['id']}'";
		$save_student = $this->db->query($update_student_query);
		if (!$save_student) {
			return 0; // Failed to update student bio
		}
	
		// If everything is successful, return 1
		return 1; // Success
	}
	

	function save_settings(){
		extract($_POST);
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['settings'][$key] = $value;
		}

			return 1;
				}
	}

	
	function save_course(){
		extract($_POST);
		$data = " course = '$course' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO courses set $data");
			}else{
				$save = $this->db->query("UPDATE courses set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function delete_course(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM courses where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function update_alumni_acc(){
		extract($_POST);
		$update = $this->db->query("UPDATE alumnus_bio set status = $status where id = $id");
		if($update)
			return 1;
	}

	function update_student_acc(){
		extract($_POST);
		$update = $this->db->query("UPDATE student_bio set status = $status where id = $id");
		if($update)
			return 1;
	}

	function save_stories(){
		extract($_POST);
		$img = array();
  		$fpath = 'assets/uploads/stories';
		$files= is_dir($fpath) ? scandir($fpath) : array();
		foreach($files as $val){
			if(!in_array($val, array('.','..'))){
				$n = explode('_',$val);
				$img[$n[0]] = $val;
			}
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO stories set about = '$about' ");
			if($save){
				$id = $this->db->insert_id;
				$folder = "assets/uploads/stories/";
				$file = explode('.',$_FILES['img']['name']);
				$file = end($file);
				if(is_file($folder.$id.'/_img'.'.'.$file))
					unlink($folder.$id.'/_img'.'.'.$file);
				if(isset($img[$id]))
						unlink($folder.$img[$id]);
				if($_FILES['img']['tmp_name'] != ''){
					$fname = $id.'_img'.'.'.$file;
					$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/stories/'. $fname);
				}
			}
		}else{
			$save = $this->db->query("UPDATE stories set about = '$about' where id=".$id);
			if($save){
				if($_FILES['img']['tmp_name'] != ''){
					$folder = "assets/uploads/stories/";
					$file = explode('.',$_FILES['img']['name']);
					$file = end($file);
					if(is_file($folder.$id.'/_img'.'.'.$file))
						unlink($folder.$id.'/_img'.'.'.$file);
					if(isset($img[$id]))
						unlink($folder.$img[$id]);
					$fname = $id.'_img'.'.'.$file;
					$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/stories/'. $fname);
				}
			}
		}
		if($save)
			return 1;
	}
	function delete_stories(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM stories where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_career(){
		extract($_POST);
		$data = " company = '$company' ";
		$data .= ", job_title = '$title' ";
		$data .= ", location = '$location' ";
		$data .= ", link = '$link' ";
		$data .= ", description = '".htmlentities(str_replace("'","&#x2019;",$description))."' ";

		if(empty($id)){
			// echo "INSERT INTO careers set ".$data;
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("INSERT INTO careers set ".$data);
		}else{
			$save = $this->db->query("UPDATE careers set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_career(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM careers where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_education(){
		extract($_POST);
		$data = " institution = '$institution' ";
		$data .= ", program = '$program' ";
		$data .= ", location = '$location' ";
		$data .= ", link = '$link' ";
		$data .= ", description = '".htmlentities(str_replace("'","&#x2019;",$description))."' ";

		if(empty($id)){
			// echo "INSERT INTO education set ".$data;
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("INSERT INTO education set ".$data);
		}else{
			$save = $this->db->query("UPDATE education set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_education(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM education where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_forum(){
		extract($_POST);
		$data = " title = '$title' ";
		$data .= ", description = '".htmlentities(str_replace("'","&#x2019;",$description))."' ";

		if(empty($id)){
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("INSERT INTO forum_topics set ".$data);
		}else{
			$save = $this->db->query("UPDATE forum_topics set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_forum(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM forum_topics where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_comment(){
		extract($_POST);
		$data = " comment = '".htmlentities(str_replace("'","&#x2019;",$comment))."' ";

		if(empty($id)){
			$data .= ", topic_id = '$topic_id' ";
			$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("INSERT INTO forum_comments set ".$data);
		}else{
			$save = $this->db->query("UPDATE forum_comments set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_comment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM forum_comments where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_event(){
		extract($_POST);
		$data = " title = '$title' ";
		$data .= ", schedule = '$schedule' ";
		$data .= ", content = '".htmlentities(str_replace("'","&#x2019;",$content))."' ";
		if($_FILES['banner']['tmp_name'] != ''){
						$_FILES['banner']['name'] = str_replace(array("(",")"," "), '', $_FILES['banner']['name']);
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['banner']['name'];
						$move = move_uploaded_file($_FILES['banner']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", banner = '$fname' ";

		}
		if(empty($id)){

			$save = $this->db->query("INSERT INTO events set ".$data);
		}else{
			$save = $this->db->query("UPDATE events set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_event(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM events where id = ".$id);
		if($delete){
			return 1;
		}
	}
	
	function participate(){
		extract($_POST);
		$data = " event_id = '$event_id' ";
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
		$commit = $this->db->query("INSERT INTO event_commits set $data ");
		if($commit)
			return 1;

	}
}