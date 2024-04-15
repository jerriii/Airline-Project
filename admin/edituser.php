<?php
include '../utils/startsession.php';
include "../utils/database.php";
include '../utils/User.php';
include '../utils/error.php';

if (!User::isLoggedIn())
	ErrorHandler::error(9, '../login.php');
$user=User::getUserFromSession();
if (!$user->isAdmin()) 
	ErrorHandler::error(10, '../index.php');
    
$id = $_GET['updateid'];
$sql = "SELECT * FROM users WHERE id=$id";

$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$email = $row['email'];


if (isset($_POST['submit']))
{
    $username=$_POST['username'];
    $email=$_POST['email'];
    
    $sql = "UPDATE users
    SET id='$id',username='$username', email='$email' WHERE id=$id";
    
    $result = mysqli_query($db,$sql);
    
    if ($result)
    {
        header('location:user.php');
    }
    else
    {
        die(mysqli_error($db));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | User</title>
		<link rel="stylesheet" type="text/css" href="../layout.css">
		<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div class="form-box">
        <form method="post"  enctype="multipart/form-data" class="inp-group" style="margin-left: 40px">        
                <input type="text" class="inp" value="<?php echo $row['username'];?>" name="username" required>
            <br>
                <input type="text" class="inp" value="<?php echo $row['email'];?>" name="email" required>
            <br>
                <button type="submit"  name="submit" class="sub">Edit</button>
                <a href="user.php">
                    <button type="button" class="sub">Back</button>
                </a>
        </form>
    </div>
</body>
</html>