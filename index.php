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
header('location: admin/home.php');

$sql = "SELECT * FROM votes WHERE user_id=".$user->userid;
$voted = mysqli_query($db, $sql);
$haveVoted = false;

$sql ="SELECT * FROM candidate"; 
if(mysqli_num_rows($voted)==1) {
    $sql=$sql." ORDER BY (case when id=".mysqli_fetch_assoc($voted)['candidate_id'].' then 1 else 2 end) ';
    $haveVoted = true;
}

$result = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        
        <link rel="stylesheet" href="layout.css">

</head>
<body>
    <div class="header">
        <div class="icon">
            <h2>Online Voting System</h2>
        </div>
        <div class="user-details">
            <ul>
                <li>
                    User: <?php echo $user->username;?>
                </li>
                <li>
                   <a href="utils/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class='main' >
    <?php if (mysqli_num_rows($result)!=0):?>
        <?php while ($row = mysqli_fetch_assoc($result)):?>
        <div class="box-details">
            <img src="<?php echo $row["photo"]; ?>">
            <div style="text-align: center;">
                <h2 style='display: inline'>
                    <span><?php echo $row['name'];?></span>
                </h2>
                <br>
                <h4 style='display: inline'>
                    <span><?php echo $row['party']?></span>
                </h4>
                <br>
            </div>
            <div>
                <?php if($haveVoted):?>
                    <?php $haveVoted = false;?>
                    <span>Voted</span>
                <?php else:?>
                    <a href="votes.php?id=<?php echo $row['id'];?>">
                        <button class="btn">
                        Vote
                        </button>
                    </a>
                <?php endif;?>
            </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</body>
</html>