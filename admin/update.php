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
$sql = "SELECT * from candidate WHERE id=$id";

$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$party = $row['party'];
$photo = $row['photo'];


if (isset($_POST['submit']))
{
    $name=$_POST['name'];
    $party=$_POST['party'];
    $photo=$_FILES['photo'];
    $img_loc = $_FILES['photo']['tmp_name'];
    $img_name = $_FILES['photo']['name'];
    $img_des = "candidateImage/".$img_name;
    
    move_uploaded_file($img_loc,'candidateImage/'.$img_name);
    
    
    $sql = "UPDATE candidate
    SET id='$id',name='$name', party='$party' ";
    if(!empty($photo)) 
    $sql=$sql.", photo='$img_des' "; 
    $sql=$sql."WHERE id=$id";
    $result = mysqli_query($db,$sql);
    
    if ($result)
    {
        header('location:candidate.php');
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
    <title>Update | Candidate</title>
		<link rel="stylesheet" type="text/css" href="../layout.css">
		<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <div class="form-box">
        <form method="post"  enctype="multipart/form-data" class="inp-group" style="margin-left: 40px">        
                <input type="text" class="inp" value="<?php echo $row['name'];?>" name="name" required>
            <br>
                <input type="text" class="inp" value="<?php echo $row['party'];?>" name="party" required>
            <br>
                <input type="file" name="photo" class="custom-file-input" accept=".png, .jpg, .jpeg" required>
            <br>
                <button type="submit"  name="submit" class="sub">Update</button>
                <a href="candidate.php">
                    <button type="button" class="sub">Back</button>
                </a>
        </form>
    </div>
</body>
</html>