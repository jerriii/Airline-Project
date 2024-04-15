<?php 
	include 'startsession.php';
	include_once 'database.php';
	include 'error.php';
	include 'User.php';
	include 'strip_string.php';
?>
<?php
	$redirect = "../login.php";
	if (!isset($_POST['email']) || !isset($_POST['password']))
		ErrorHandler::error(1, $redirect);
    $email = e($_POST['email']);
    $password = e($_POST['password']);
	if ($email == '' || $password == '')
		ErrorHandler::error(2, $redirect);
	$password = md5($password);
	$query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
	$results = mysqli_query($db, $query);

	if (mysqli_num_rows($results) != 1)
		ErrorHandler::error(3, $redirect);

	$user = new User(mysqli_fetch_assoc($results));
	$user->setUserInSession();
	$_SESSION['success'] = 'You are now logged in';
	if ($user->isAdmin()) 
		header('location: ../admin/home.php');
	else 
		header('location: ../index.php');
?>