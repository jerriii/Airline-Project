<?php

    include 'startsession.php';
    include 'database.php';
    include 'error.php';
    include 'User.php';

    if(!User::isLoggedIn())
        ErrorHandler::error(9,"../login.php");
    $user = User::getUserFromSession();
    $flight_id = @$_GET['id'];
    $seats = @$_GET['seats'];

    $sql = "INSERT INTO bookings(user_id, flight_id, seats) VALUES ('$user->userid','$flight_id', '$seats')";
    $result= mysqli_query($db,$sql);
    header('location:../index.php');
        
?>