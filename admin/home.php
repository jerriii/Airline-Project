<?php 
include '../utils/startsession.php';
include_once '../utils/database.php';
include '../utils/User.php';
include '../utils/error.php';

if (!User::isLoggedIn())
	ErrorHandler::error(9, '../login.php');
$user=User::getUserFromSession();

if (!$user->isAdmin()) 
	ErrorHandler::error(10, '../index.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../res/css/design.css">
	<link rel="stylesheet" type="text/css" href="../res/css/homepage.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
</head>
<body>
<div class="head adminphoto">
    <div class="navbar">
            <div class="icon left">
                <h2 class="logo red_color">ATS</h2>
            </div>
            	<div class="menu-admin">
            		<ul>
                		<li><a href="display.php">FLIGHTS</a></li>
                		<li><a href="passenger.php"> PASSENGERS</a></li>
                		<li>
							<a href="../utils/logout.php">
								<i for="logout">
									<span class="material-icons-outlined">logout</span>
								</i>
							</a>
               			</li>
            		</ul>
            	</div>
					<br><br>
           			<br><br>
            		<br>
				<div class="data">
					<h1>
						Welcome Administrator!
					</h1>
				</div>
				<div class="content">
					<?php if (isset($_SESSION['success'])) : ?>
				<!-- <div class="error success" >
					<h3>
						<?php 
							echo $_SESSION['success']; 
							unset($_SESSION['success']);
						?>
					</h3>
				</div> -->
				<?php endif ?>
				</div>
	</div>
</div>
</body>
</html>