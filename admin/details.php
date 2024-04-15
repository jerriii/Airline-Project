<?php
include "../utils/startsession.php";
include "../utils/database.php";
include_once "../utils/error.php";
include_once "../utils/User.php";

if (!User::isLoggedIn())
	ErrorHandler::error(9, '../login.php');
$user=User::getUserFromSession();
if (!$user->isAdmin()) 
	ErrorHandler::error(10, '../index.php');

    $id=@$_GET['id'];

    $sql="SELECT users.id, users.username, bookings.seats FROM bookings  
        INNER JOIN users ON bookings.user_id=users.id WHERE bookings.flight_id=$id";
    $result=mysqli_query($db,$sql);
    
    while($row= mysqli_fetch_assoc($result))
        print_r($row);

?>