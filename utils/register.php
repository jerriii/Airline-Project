<?php
	include "startsession.php";
	include_once "database.php";
	include "error.php";
    include "strip_string.php";
?>
<?php

    $username = e(@$_POST['username']);
    $email = e(@$_POST['email']);
    $password = e(@$_POST['password']);
    $confirm_password = e(@$_POST['confirm_password']);

    if (empty($username))
        ErrorHandler::error(4, '../register.php');
    if (empty($email))
        ErrorHandler::error(5, '../register.php');
    if (empty($password)) 
        ErrorHandler::error(6, '../register.php');
    if ($password != $confirm_password)
        ErrorHandler::error(7, '../register.php');
	$password = md5($password); 

	$query = "INSERT INTO users (username, email, user_type, password) 
				VALUES('$username', '$email', 'user', '$password')";
	$_SESSION['success'] = 'New user successfully created!!';
	mysqli_query($db, $query);

	header('location: ../login.php');
?>