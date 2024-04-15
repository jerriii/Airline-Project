	<?php 
		include 'utils/startsession.php';
		include_once 'utils/database.php';
		include 'utils/error.php';
		include 'utils/User.php';

		if (User::isLoggedIn())
			ErrorHandler::error(8, "index.php");

	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="res/css/design.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="res/css/form.css">
	</head>
	<body>
	<div class="head loginphoto">
			<div class="navbar">
				<div class="icon left">
					<h2 class="logo blue_color">ATS</h2>
				</div>

				<div class="menu-user">
					<ul>
						
						<li><a href="register.php">REGISTER</a></li>
						<li><a href="aboutus.php">ABOUT US</a></li>

					</ul>
				</div>

			</div> 
			<br><br>
			<br><br>
			<br>
			<div class="data left">
				<h1>Welcome 
					<br> 
					to 
					<br>
					Airline Ticketing System
				</h1>
			</div>

				<br>	

			<div class="form right">
				<form method="post" action="utils/login.php">
					<h2 class="heading">Login</h2>
					<?php ErrorHandler::display_error(); ?>

					<div class="form-group">
						<label for="name" class="input-label">Username</label>
						<input type="text" name="username" id="name" class="absolute form-control"/>	
					</div>
					<br /><br />

					<div>
						<div class="form-group">
							<label for="password" class="input-label" >Password</label>
							<div class="pwd-group absolute">
								<input type="password" name="password" id="password" class="form-control"/>
								<i for="password" class="viewpwd">
									<span class="material-icons-outlined">visibility</span>
								</i>
							</div>
						</div>
					</div>
					<br /><br />
					<button type="submit" class="btn" name="login_btn">Login</button>

					<p class="base">
						Not a member yet? <a href="register.php">Sign up</a>
					</p>
				</form>
			</div>
	</div>
	<script src="js/function.js"></script>
	</body>
	</html>