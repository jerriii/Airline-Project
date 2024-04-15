<?php
    include_once 'utils/startsession.php';
    include_once 'utils/User.php';
    include_once 'utils/database.php';

    if (!User::isLoggedIn()) 
	    ErrorHandler::error(9, 'login.php');
    $user = User::getUserFromSession();

    if ($user->isAdmin())
    header('location: admin/home.php');

    $candidate_id=$_GET['id'];
    $user_id=$user->userid;
    
    mysqli_query($db,"DELETE FROM votes WHERE user_id=$user_id");

    mysqli_query($db,"INSERT INTO votes(candidate_id, user_id) VALUES ($candidate_id, $user_id)");
    header ('location: index.php');
?>