<?php
include "utils/startsession.php";
include "utils/database.php";
include_once "utils/User.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>About us</title>
    <link rel="stylesheet" href="res/css/design.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
    <link rel="stylesheet" href="res/css/homepage.css">
</head>
<body>
    <div class="head loginphoto">
        <div class="navbar">
            <div class="icon left">
                <h2 class="logo blue_color"><a href="index.php">ATS</a></h2>
            </div>

            <div class="menu-user">
                <ul>
                    <?php if (User::isLoggedIn()):?>
                    <li>
                        <a href="utils/logout.php">
                            <i for="logout">
								<span class="material-icons-outlined">logout</span>	
                            </i>
                        </a>
                    </li>
                    
                    <?php else:?>
                    <li><a href="login.php">LOGIN</a></li>
                    <li><a href="register.php">REGISTER</a></li>
                    <?php endif;?>
                </ul>
            </div>
        </div> 
        <div class="content">
				<h1>
					Airline<br>
					Ticketing<br>
					System
				</h1>
            <p class="par">An Airline Ticketing System is a software solution that allows 
            users to self-book online tickets. Airline Ticketing system (ATS) is system for public users 
            to book and cancel the ticket. This system allows customers to search availability and price of airline tickets. 
            Here, in this system we can book one or more flight and cancel it if needed.
                </p>
                </div>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>