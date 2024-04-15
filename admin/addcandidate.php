<?php
include "../utils/startsession.php";
include "../utils/database.php";
include_once "../utils/error.php";
include_once "../utils/User.php";

if (!User::isLoggedIn())
    ErrorHandler::error(9, '../login.php');
$user=User::getUserFromSession();
if (!$user->isAdmin()) 
    ErrorHandler::error(10, '../index.php');

if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $party=$_POST['party'];
    $photo=$_FILES['photo'];
    $img_loc = $_FILES['photo']['tmp_name'];
    $img_name = $_FILES['photo']['name'];
    $img_des = "candidateImage/".$img_name;
    move_uploaded_file($img_loc,'candidateImage/'.$img_name);

    $sql="INSERT INTO candidate ( name,  party, photo) 
    VALUES ('$name','$party','$img_des')";
    $result = mysqli_query($db,$sql);

    if($result)
        header('location:candidate.php');
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
    <title>Add | Candidate</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../layout.css">
</head>
<body>
    <div class="form-box">
        <form method="post" class="inp-group" style="margin-left: 40px" enctype="multipart/form-data">        
                <input type="text" class="inp" placeholder="Enter Candidate name" name="name" required>
            <br>
                <input type="text" class="inp" placeholder="Enter political party" name="party" required>
            <br>
                <input type="file"  name="photo" class="custom-file-input" accept=".png, .jpg, .jpeg" required>
                <br>
                <button type="submit"  name="submit" class="sub">Add</button>
                <a href="candidate.php">
                    <button type="button" class="sub">Back</button>
                </a>
            </div>
        </form>
    </div>    
</body>
</html>