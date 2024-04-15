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
		<link rel="stylesheet" type="text/css" href="res/css/dialog.css">

    </head>
    <body>
    
        <div class="head userphoto">
            <div class="navbar">
				<div class="icon left">
					<h2 class="logo blue_color"><a href="index.php">ATS</a></h2>
				</div>

                <div class="menu-user right">
                <ul class="menu-user right">
                    <li>
                        User:<?php echo $user->username;?>
                    </li>
                </ul>
                </div>

			</div> 

            <dialog close id="book-dialog" class="popup">
                <button onclick="getElementById('book-dialog').close()" class="close-dialog">
                    <i for="close">
                        <span class="material-icons-outlined">close</span>
                    </i>
                </button>
                <br><br>
                <h2 id="booking_name"></h2>
                <h3 id="booking_destination">
                    <span id="booking_departure"></span>
                    -
                    <span id="booking_arrival"></span>
                </h3>
                <h4 id="booking_datetime">
                    <span id="booking_departure_date"></span>
                    :
                    <span id="booking_departure_time"></span>
                </h3>
                <form action="utils/booking.php" id="booking-form" method="get">
                    <input type="button" id="minus-seats" value="-"/>
                    <span id="booked-seats"></span>
                    <input type="button" id="add-seats" value="+"/><br>
                    <input hidden type="number" name="seats" id="booking_seats">
                    <input hidden type="number" name="id" id="booking_id">
                    <input type="submit" class="btn-primary bg-blue" value="Book">
                </form>
            </dialog>
            <br>
            <div class='list margin_left' >
            <?php if (mysqli_num_rows($result)!=0):?>
                <?php while ($row = mysqli_fetch_assoc($result)):?>
                <div class="left">
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
                        <button class="btn-book bg-blue right" onclick="openBookDialog(<?php echo $row['id']?>)">
                            Edit
                        </button>
                        <a href="utils/booking.php?id=<?php echo $row['id']?>&action=delete">
                            <button class="btn-book bg-blue right">
                                Delete
                            </button>
                        </a>
                    </div>
                </div>
                    <br>
                <?php endwhile; ?>
            <?php endif; ?>
            
            </div>
        </div>
        <script src="js/seats.js"></script>
    </body>
    </html>