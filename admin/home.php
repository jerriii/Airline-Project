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

$sql="SELECT * FROM candidate";
$result=mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../layout.css">

</head>
<body>
    <div class="header">
        <div class="icon">
            <h2>Online Voting System</h2>
        </div>
        <div class="user-details">
            <ul>
                <li>
                    <a href="candidate.php"><div class="title">Candidate</div></a>
                </li>
                <li>
                    <a href="user.php"><div class="title">Users</div></a>
                </li>
                <li>
                    <a href="../utils/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <div class='main'>
    <?php if (mysqli_num_rows($result)!=0):?>
        <?php while ($row = mysqli_fetch_assoc($result)):?>
            <?php $sql = "SELECT * FROM votes WHERE candidate_id = ".$row['id'];?>
            <div class="box-details">
                <img src="../<?php echo $row["photo"]; ?>">
                <div style="text-align: center;">
                    <h2 style='display: inline'>
                        <span><?php echo $row['name'];?></span>
                    </h2>
                    <br>
                    <h4 style='display: inline'>
                        <span><?php echo $row['party'];?></span>
                    </h4>
                    <br>
                    <h5>Vote: <?php echo mysqli_num_rows(mysqli_query($db, $sql));?></h5>
                </div>
            </div>
        <?php endwhile;?>
    <?php endif;?>
    </div>
</body>
</html>