<?php
    include 'utils/startsession.php';
    include 'utils/database.php';
    include 'utils/User.php';

    $user=User::getUserFromSession();
    $sql="SELECT  FROM bookings 
    INNER JOIN flights
    ON bookings.flight_id=flights.id
    WHERE bookings.user_id=$user->"

?>