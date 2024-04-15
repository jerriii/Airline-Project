<?php
	include "../utils/startsession.php";
	include "../utils/database.php";
	include "../utils/User.php";

    $date = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passengers | ATS</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="../res/css/design.css">
		<link rel="stylesheet" href="../res/css/form.css">
		<link rel="stylesheet" type="text/css" href="../res/css/homepage.css">
</head>
<body>
<div class="head adminphoto">
    <div class="navbar">
        <div class="icon left">
            <h2 class="logo red_color"><a href="home.php">ATS</a></h2>
        </div>
    </div> 
    <div class="list left margin_left">
        <?php
            $sql="SELECT * FROM flights WHERE departure_date= '$date'";
            $result=mysqli_query($db, $sql);
        ?>
        <?php if ($result): ?>
            <?php while($row=mysqli_fetch_assoc($result)): ?>

                <?php
                    $sql = "SELECT seats FROM bookings where flight_id=".$row['id'];
                    $seat_results = mysqli_query($db, $sql);
                    $seatsBooked = 0;
                    if (mysqli_num_rows($seat_results) > 0)
                        while ($seats = mysqli_fetch_assoc($seat_results)) $seatsBooked += $seats['seats'];
                    $soldOut= $seatsBooked==$row['seats'];
                ?>

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
                        <p style='display: inline'>
                            <?php echo ($row['seats']-$seatsBooked == 0) ? 'No' : $row['seats']-$seatsBooked; ?>
                            seat<?php echo ($row['seats']-$seatsBooked == 1)?'':'s'?> remain
                        </p>
                    </div>
                    <button <?php if($soldOut) echo "disabled"?> class="btn-book bg-red right" onclick="openBookDialog(<?php echo $row['id']?>)">
                        Details
                    </button>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>   
</div> 
                

</body>
</html>

