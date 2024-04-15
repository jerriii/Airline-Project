<?php
	include "startsession.php";
	include_once "database.php";
	include "error.php";
    include "strip_string.php";
?>
<?php

    $redirect='../login.php';
    $username = e(@$_POST['username']);
    $email = e(@$_POST['email']);
    $password = e(@$_POST['password']);
    $confirm_password = e(@$_POST['confirm_password']);

    if (empty($username))
        ErrorHandler::error(4, $redirect);

    if (empty($email))
        ErrorHandler::error(5, $redirect);

    if (empty($password)) 
        ErrorHandler::error(6, $redirect);

    if ($password != $confirm_password)
        ErrorHandler::error(7, $redirect);

	$password = md5($password); 

    $query = "SELECT * FROM users WHERE email='$email'";
	$results = mysqli_query($db, $query);

	if (mysqli_num_rows($results) == 1)
		ErrorHandler::error(12, $redirect);

	$query = "INSERT INTO users (username, email, user_type, password) 
				VALUES('$username', '$email', 'user', '$password')";
	$_SESSION['success'] = 'New user successfully created!!';
	mysqli_query($db, $query);

	header('location: ../login.php');
?>