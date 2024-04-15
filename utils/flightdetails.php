<?php
header('Content-Type: application/json');
include "startsession.php";
include "database.php";
include "error.php";
include "User.php";


    if(!User::isLoggedIn()) {
        echo json_encode([
            "message"=>ErrorHandler::ERROR_LIST[9]
        ]);
        die();
    }


    if(!isset($_GET['id'])) {
        echo json_encode([
            "message"=>ErrorHandler::ERROR_LIST[11]
        ]);
        die();
    }

    $user = User::getUserFromSession();
    $id = $_GET['id'];

    $sql="SELECT * FROM flights WHERE id=$id";
    $result=mysqli_query($db,$sql);
    if(mysqli_num_rows($result) != 1)
        die();
    $flightDetails = mysqli_fetch_assoc($result);
    
    $sql = "SELECT seats FROM bookings where flight_id=$id";
    $result = mysqli_query($db, $sql);
    $seatsBooked = 0;
    if (mysqli_num_rows($result) > 0)
        while ($seats = mysqli_fetch_assoc($result)) $seatsBooked += $seats['seats'];

    $flightDetails["seats_booked"] = $seatsBooked;

    $sql = "SELECT seats FROM bookings WHERE user_id = $user->userid AND flight_id =$id";
    $result = mysqli_query($db,$sql);

    if(mysqli_num_rows($result)===1) 
        $flightDetails['user_seats_booked'] = mysqli_fetch_assoc($result)['seats'];
    
    else
        $flightDetails['user_seats_booked'] = 0;
        
    echo json_encode($flightDetails);
    
?>
