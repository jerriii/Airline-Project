    <?php
        include "utils/startsession.php";
        include "utils/database.php";
        include_once "utils/error.php";
        include_once "utils/User.php";

        $user = User::getUserFromSession();

        $date = date('Y-m-d');
        $time = date('h:i:s');

        $sql= "SELECT flights.id, flights.name, flights.aeroplane_no, 
                flights.departure, flights.arrival, flights.departure_date, 
                flights.departure_time, bookings.seats FROM bookings 
                INNER JOIN flights ON bookings.flight_id=flights.id
                WHERE (bookings.user_id=$user->userid) 
                AND (DATE(flights.departure_date)>='$date')"; 
                // AND TIME(flights.departure_time)>=$time";
        
        $result = mysqli_query($db, $sql);


    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile | ATS</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="res/css/design.css">
		<link rel="stylesheet" href="res/css/form.css">
		<link rel="stylesheet" type="text/css" href="res/css/homepage.css">
    </head>
    <body>
    
        <div class="head userphoto">
            <div>
                User:<?php echo $user->username;?>
            </div>
            <br>
            <div>
            <?php if (mysqli_num_rows($result)!=0):?>
                <?php while ($row = mysqli_fetch_assoc($result)):?>
                <div class="list left margin_left">
                    <div class="airline-details">
                        <div>
                            <h2 style='display: inline'><?php echo $row['name']; ?> - <span><?php echo $row['aeroplane_no']; ?></span></h2><br>
                            <h4 style='display: inline'>
                                <span><?php echo $row['departure']; ?></span>
                                -
                                <span><?php echo $row['arrival']; ?> </span>
                            </h4><br>
                            <h5 style='display: inline'>
                                <span><?php echo $row['departure_date']; ?></span>
                                <span><?php echo $row['departure_time']; ?></span>
                            </h5><br>
            
                        </div>
                        <!-- <button <?php// if($soldOut) echo "disabled"?> class="btn-book bg-blue right" onclick="openBookDialog(<?php echo $row['id']?>)">
                            Book now
                        </button> -->
                    </div>
                </div>
                    <br>
                <?php endwhile; ?>
            <?php endif; ?>
            
            </div>
        </div>
    </body>
    </html>