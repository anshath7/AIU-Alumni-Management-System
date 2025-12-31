<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}

if($action == 'login3'){
	$login = $crud->login3();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}


if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'delete_alumni'){
	$save = $crud->delete_alumni();
	if($save)
		echo $save;
}
if($action == 'delete_student'){
	$save = $crud->delete_student();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}

if($action == 's_signup'){
	$save = $crud->s_signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == 's_update_account'){
	$save = $crud->s_update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_course"){
	$save = $crud->save_course();
	if($save)
		echo $save;
}

if($action == "delete_course"){
	$delete = $crud->delete_course();
	if($delete)
		echo $delete;
}
if($action == "update_alumni_acc"){
	$save = $crud->update_alumni_acc();
	if($save)
		echo $save;
}
if($action == "update_student_acc"){
	$save = $crud->update_student_acc();
	if($save)
		echo $save;
}
if($action == "save_stories"){
	$save = $crud->save_stories();
	if($save)
		echo $save;
}
if($action == "delete_stories"){
	$save = $crud->delete_stories();
	if($save)
		echo $save;
}

if($action == "save_career"){
	$save = $crud->save_career();
	if($save)
		echo $save;
}
if($action == "delete_career"){
	$save = $crud->delete_career();
	if($save)
		echo $save;
}
if($action == "save_education"){
	$save = $crud->save_education();
	if($save)
		echo $save;
}
if($action == "delete_education"){
	$save = $crud->delete_education();
	if($save)
		echo $save;
}
if($action == "save_forum"){
	$save = $crud->save_forum();
	if($save)
		echo $save;
}
if($action == "delete_forum"){
	$save = $crud->delete_forum();
	if($save)
		echo $save;
}

if($action == "save_comment"){
	$save = $crud->save_comment();
	if($save)
		echo $save;
}
if($action == "delete_comment"){
	$save = $crud->delete_comment();
	if($save)
		echo $save;

}

if($action == "save_event"){
	$save = $crud->save_event();
	if($save)
		echo $save;
}
if($action == "delete_event"){
	$save = $crud->delete_event();
	if($save)
		echo $save;
}	
if($action == "participate"){
	$save = $crud->participate();
	if($save)
		echo $save;
}
if($action == "get_venue_report"){
	$get = $crud->get_venue_report();
	if($get)
		echo $get;
}




if(isset($_POST['action']) && $_POST['action'] == 'check_admin') {
    // Get the current user's login credentials from session or database
    $user_id = $_SESSION['login_id'];  // assuming session contains user ID
    $result = $conn->query("SELECT `type` FROM `users` WHERE `id` = '$user_id'");
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if($user['type'] == 1) { // Check if type is 1 (admin)
            echo '1';
        } else {
            echo '0';
        }
    } else {
        echo '0'; // User not found
    }
}

if($action == "get_pdetails"){
	$get = $crud->get_pdetails();
	if($get)
		echo $get;
}
ob_end_flush();
?>
