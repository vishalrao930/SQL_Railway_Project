<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'dbms_pro');
$username="";
$email="";
$errors= array();
function display_errors(){
    global $errors;
    if(count($errors)>0){
        echo('<div class="alert alert-danger"><ul>');
        foreach ($errors as $error)
            echo("<li> $error </li>");
        echo("</ul></div>");
    }
}

if (isset($_POST['Register'])) {
	register();
	
}
if (isset($_POST['LogIn'])) {
	login();
}
if(isset($_GET['logout'])){
	unset($_SESSION['user']);
	session_destroy();
}

function register(){
    // global $db;
    global $email,$errors,$username,$db;

    $username=e($_POST['username']);
    $email=e($_POST['email']);
    $phone=e($_POST['number']);
    $password1=e($_POST['password']);
    $password2=e($_POST['confirm_password']);

	if (empty($username)) { 
		array_push($errors, "Name is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
    }
    if (empty($phone)) {
        array_push($errors, "Phone Number is required.");
    }
	if (empty($password1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password1 != $password2) {
		array_push($errors, "The two passwords do not match");
    }    
    if (count($errors) == 0) {
		$password = md5($password1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (name, email, isAdmin, password, phone) 
					  VALUES('$username', '$email', 1, '$password', '$phone')";
			mysqli_query($db, $query);
			// $_SESSION['success']  = "New user successfully created!! You can Log In.";
			// header('location: login.php');
		}else{
			$query = "INSERT INTO users (name, email, password, phone) 
					  VALUES('$username', '$email', '$password','$phone')";
			mysqli_query($db, $query);

			// // get id of the created user
			// $logged_in_user_id = mysqli_insert_id($db);

			// $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			// $_SESSION['user']=true;
						
		}
		$_SESSION['success']  = "New User Created Succesfully. You can now log In.";
		header('location: ./login.php');	
	}
}
function login(){
	global $email,$errors,$db;
	// global $db;
	$email=e($_POST['email']);
	$password=e($_POST['password']);

	if (empty($email)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	if (count($errors) == 0) {
		// if($email=='a@b.co' and $password=="123"){
		// 	$_SESSION['user']="1";
		// 	header('location: ./index.php');
		// }
		// else{
		// 	array_push($errors,"Wrong username and Password!");
		// }

		$password = md5($password);

		$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in";

			header('location: index.php');
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}
function isAdmin(){
	if(isset($_SESSION['user'])){
		if($_SESSION['user']['isAdmin']==1)	return true;
		return false;
	}
	return false;
}
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

?>