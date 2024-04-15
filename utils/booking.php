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

    if(isset($_GET['action']) && $_GET['action'] === 'delete') {
        $sql = "DELETE FROM bookings WHERE user_id=$user->userid AND flight_id=$flight_id";  
        mysqli_query($db,$sql);
        header('location:../index.php');
        die();
    } 


    $sql = "SELECT id FROM bookings WHERE user_id=$user->userid AND flight_id=$flight_id";
    $result = mysqli_query($db,$sql);
    if (mysqli_num_rows($result) == 1)
        $sql = "UPDATE bookings
        SET seats = $seats
        WHERE id=".mysqli_fetch_assoc($result)['id'];

    else
        $sql = "INSERT INTO bookings(user_id, flight_id, seats) VALUES ('$user->userid','$flight_id', '$seats')";
    $result= mysqli_query($db,$sql);
    header('location:../index.php');
        
?>
    



