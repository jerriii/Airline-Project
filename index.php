<?php
	include "utils/startsession.php";
	include "utils/database.php";
	include_once "utils/error.php";
	include_once "utils/User.php";
?>
<?php
if (!User::isLoggedIn()) 
	ErrorHandler::error(9, 'login.php');
$user = User::getUserFromSession();

if ($user->isAdmin())
	header('location: admin/home.php')
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home | ATS</title>
		<link rel="stylesheet" type="text/css" href="res/css/design.css">
		<link rel="stylesheet" type="text/css" href="res/css/form.css">
		<link rel="stylesheet" type="text/css" href="res/css/homepage.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
	</head>
	<body>
		<div class="head userphoto">
			<div class="navbar">
				<div class="icon left">
					<h2 class="logo blue_color">ATS</h2>
				</div>

				<div class="menu-user right">
					<ul class="menu-user right">
						<li>
							<a href="aboutus.php">ABOUT US</a>
						</li>
						<li>
							<a href="profile.php"><i for="account-user">
								<span class="material-icons-outlined">account_circle</span>	
                            </i></a>
						</li>
						<li>
							<a href="utils/logout.php">
								<i for="logout">
									<span class="material-icons-outlined">logout</span>
								</i>
							</a>
						</li>
					</ul>
				</div>
			</div> 
			<br><br>
			<br><br>
			<br>
			<div class="data left">
				<h1>
					Airline<br>
					Ticketing<br>
					System
				</h1>
			</div>


			<form method="get" action="search.php">
				<div class="form right">
					<h2 class="heading">Welcome</h2>
					<br>
					<div class="profile_info">
						<strong>
							User: <?php echo $user->username; ?>
						</strong>
						
						<?php ErrorHandler::display_error(); ?>
					</div>
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
									echo "<option value='$departure'>$departure</option>";
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
									echo "<option value='$arrival'>$arrival</option>";
									array_push($arrivals_added, $arrival);
								}
							}
							?>
							</select>
							<label for="trip" class="input-select">Trip Date</label>
							<input type="date" id="trip-date" name="trip-date" class="option" required>	
						</div>
						<input type="submit" class="btn-select" value="Search">
				</div>
			</form>
		</div>
		<script>
			let tripdate=document.getElementById('trip-date');
			let date=new Date();
			tripdate.min= date.toLocaleDateString('en-ca');
			tripdate.value= date.toLocaleDateString('en-ca');
			date.setMonth(date.getMonth()+2);
			tripdate.max= date.toLocaleDateString('en-ca');
		</script>
	</body>
</html>