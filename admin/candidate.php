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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate</title>
		<link rel="stylesheet" type="text/css" href="../layout.css">
		<link rel="stylesheet" type="text/css" href="../style.css">
        <link rel="stylesheet" href="../dialog.css">
</head>
<body style="background-color: white !important;">
        <div class="header">
            <div class="icon">
                <h2>Online Voting System</h2>
            </div>
            <div class="user-details">
                <ul>
                    <li>
                        <a href="home.php"><div class="title">Back</div></a>
                    </li>
                </ul>
            </div>
        </div>

        <a href="addcandidate.php"><button>Add+</button></a>

        <div class="main">
            <?php
                $sql="SELECT * FROM candidate ";
                $result=mysqli_query($db, $sql);
            ?>
                <?php if ($result): ?>
                    <?php while($row=mysqli_fetch_assoc($result)): ?>
            <div class="box-details">
            <img src="../<?php echo $row['photo']; ?>">
            <div style="text-align: center;">
                <h2 style='display: inline'>
                    <?php echo $row['name']; ?>
                </h2>
                <br>
                <h4 style='display: inline'>
                    <?php echo $row['party']; ?>
                </h4>
                <br>
                <a href="update.php?updateid=<?php echo $row['id']; ?>">
                    <button>Update</button>
                </a>
                <a href="deletecandidate.php?deleteid=<?php echo $row['id']; ?>">
                    <button class="del">Delete</button>
                </a>
            </div>
            </div> 
            <?php endwhile;?>
            <?php endif;?>
        </div>
</body>
</html>