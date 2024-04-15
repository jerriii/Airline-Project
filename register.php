		<?php 
			include "utils/startsession.php";
			include_once "utils/database.php";
			include "utils/error.php";	
			include "utils/User.php";

			if (User::isLoggedIn()) {
				header('location: index.php');
			}
		?>

		<!DOCTYPE html>
		<html>
		<head>
			<title>Register</title>
			<link rel="stylesheet" href="res/css/design.css">
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
			<link rel="stylesheet" type="text/css" href="res/css/form.css">
		</head>
		<body>
			<div class="head loginphoto">
				<div class="navbar">
					<div class="icon left">
						<h2 class="logo blue_color ">ATS</h2>
					</div>

					<div class="menu-user">
						<ul>
							
							<li><a href="login.php">LOGIN</a></li>
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


				<form method="post" action="utils/register.php">
					<h2 class="heading">Register</h2>

					<?php ErrorHandler::display_error(); ?>

					<div class="form-group">
						<label for="name" class="input-label">Username</label>
						<input type="text" name="username" id="name" class="absolute form-control"/>	
					</div>
					<br /><br />
					<div class="form-group">
						<label for="email" class="input-label">Email</label>
						<input type="email" name="email" id="email" class="absolute form-control"/>
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
					<br><br>
					<div>
						<div class="form-group">
							<label for="confirm_password" class="input-label">Confirm Password</label>
							<div class="pwd-group absolute">
								<input type="password" name="confirm_password" id="confirm_password" class="form-control">
								<i for="confirm_password" class="viewpwd">
									<span class="material-icons-outlined">visibility</span>
								</i>
							</div>
						</div>
					</div>
					<br /><br />
					<button type="submit" class="btn" name="register_btn">Register</button>
				</form>		
			</div>
			<script src="js/function.js"></script>
		</body>
		</html>