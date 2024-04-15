<?php
	include "utils/startsession.php";
	include "utils/database.php";
	include_once "utils/error.php";
	include "utils/User.php";

?>

<?php
	$from = @$_GET['from'];
	$to = @$_GET['to'];
	$trip_date = @$_GET['trip-date'];

	if (!User::isLoggedIn())
		ErrorHandler::error(9, 'login.php');
	$user = User::getUserFromSession();
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo "$from - $to | ATS"?></title>
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

				<div class="menu-user">
					<ul>
						<li><a href="utils/logout.php">LOGOUT</a></li>
						<li><a href="aboutus.php">ABOUT US</a></li>
					</ul>
				</div>

			</div> 
			<br><br>
			<br><br>
			<br>
			
			
			
						
			<div style="padding: 0 5rem;">
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
				<form method="get" action="search.php">
					<div class="form left" style="margin-right: 3rem; margin-top: 2rem;">
						<div class="select-group">
							<label for="from" class="input-select">From</label>
							
							<select name="from" id="from" class="option" required>
							<option value="" selected disabled>-Select-</option>
							<?php
								$sql = "SELECT departure FROM flights";
								$departures=mysqli_query($db, $sql);
								$departures_added = array();
								while ($row = mysqli_fetch_assoc($departures)) 
								{
									$departure = $row['departure'];
									if (!in_array($departure, $departures_added)) 
									{
										echo "<option value='$departure' ";
										if ($_GET['from'] == $departure) echo 'selected';
										echo " >$departure</option>";
										array_push($departures_added, $departure);
									}
								}
					
							?>
							</select>
						
						
							<label for="to" class="input-select">To</label>
							<select name="to" id="to" class="option" required>
							<option value="" selected disabled>-Select-</option>
							<?php
							$sql = "SELECT arrival FROM flights";
							$arrivals = mysqli_query($db, $sql);
							$arrivals_added = array();
							while ($row = mysqli_fetch_assoc($arrivals)) {
								$arrival = $row['arrival'];
								if (!in_array($arrival, $arrivals_added)) {
									echo "<option value='$arrival' ";
									if ($_GET['to'] == $arrival) echo 'selected';
									echo ">$arrival</option>";
									array_push($arrivals_added, $arrival);
								}
							}
							?>
							</select>
							<label for="trip" class="input-select">Trip Date</label>
							<input type="date" id="trip-date" name="trip-date" class="option" value="<?php echo $_GET['trip-date']?>" required>	
						</div>
						<input type="submit" class="btn" value="Search">
					
					</div>
				</form>

				<div class="list left">
					<?php
						$sql="SELECT * FROM flights WHERE departure = '$from' AND arrival = '$to' AND departure_date = '$trip_date' ";
						$result=mysqli_query($db, $sql);
					?>
					<?php if ($result): ?>
						<?php while($row=mysqli_fetch_assoc($result)): ?>

							<?php
								$flight_id = $row['id'];
								$sql = "SELECT seats FROM bookings where flight_id=$flight_id";
								$seat_results = mysqli_query($db, $sql);
								$seatsBooked = 0;
								if (mysqli_num_rows($seat_results) > 0)
									while ($seats = mysqli_fetch_assoc($seat_results)) $seatsBooked += $seats['seats'];
								$soldOut= $seatsBooked==$row['seats'];
								$sql = "SELECT seats FROM bookings where user_id=$user->userid AND flight_id=$flight_id LIMIT 1";
								$userBooked = mysqli_query($db, $sql);
							?>

							<div class="airline-details">
								<div>
									<h2 style='display: inline'><?php echo $row['name']; ?> - <span><?php echo $row['aeroplane_no']; ?></span></h2><br>
									<h4 style='display: inline'>
										<span><?php echo $row['departure_date']; ?></span>
										<span><?php echo $row['departure_time']; ?></span>
									</h4><br>
									<p style='display: inline'>
										<?php echo ($row['seats']-$seatsBooked == 0) ? 'No' : $row['seats']-$seatsBooked; ?>
										seat<?php echo ($row['seats']-$seatsBooked == 1)?'':'s'?> remain
									</p>
								</div>

								<div>
								<?php if (mysqli_num_rows($userBooked) == 1): ?>
									<button class="btn-book bg-blue right" onclick="openBookDialog(<?php echo $row['id']?>)">Edit</button>
									<a href="utils/booking.php?id=<?php echo $row['id']?>&action=delete">
									<br><br>
										<button class="btn-book bg-blue right">
											Delete
										</button>
									</a>
									</div>
								<?php elseif ($soldOut): ?>
									<span class=right>Sold Out</span>
								<?php else: ?>
									<button class="btn-book bg-blue right" onclick="openBookDialog(<?php echo $row['id']?>)">
										Book now
									</button>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>

			</div>
		</div>
		<script src="js/seats.js"></script>
	</body>
</html>

