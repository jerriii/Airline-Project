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
$sql = "SELECT * from flights WHERE id=$id";

$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$aeroplane_no = $row['aeroplane_no'];
$departure = $row['departure'];
$arrival = $row['arrival'];

$departure_date = $row['departure_date'];
$departure_time = $row['departure_time'];

$seats = $row['seats'];

if (isset($_POST['submit']))
{
				$name = $_POST['name'];
				$aeroplane_no = $_POST['aeroplane_no'];
				$departure = $_POST['departure'];
				$arrival = $_POST['arrival'];
				$departure_date = $_POST['departure_date'];
				$departure_time = $_POST['departure_time'];
				$seats = $_POST['seats'];

				$sql = "UPDATE flights
        SET id='$id',name='$name', aeroplane_no='$aeroplane_no', departure='$departure', arrival='$arrival', departure_date='$departure_date', departure_time='$departure_time', seats='$seats' WHERE id=$id";
				$result = mysqli_query($db, $sql);

				if ($result)
				{
					header('location:display.php');
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
    <title>Airlines</title>
    <link rel="stylesheet" href="../res/css/background.css">
    <link rel="stylesheet" href="../res/css/design.css">
</head>
<body>
<div class="head">
  <form method="post">
  <div class="form">
  <label>Airline name:</label>
    <input type="text"  placeholder="Enter the Airline" name="name" value="<?php echo "$name"; ?>"required>

    <br>
    <label>Aeroplane number:</label>
    <input type="text"  placeholder="Enter aeroplane number" name="aeroplane_no" value="<?php echo "$aeroplane_no"; ?>"required>

    <br>
    <label>Departure:</label>
    <input type="text"  placeholder="Enter Departure" name="departure" value="<?php echo "$departure"; ?>"required>

    <br>
    <label>Arrival:</label>
    <input type="text"  placeholder="Enter Departure" name="arrival" value="<?php echo "$arrival"; ?>"required>

    <br>
    <label>Departure time:</label>
    <input type="date" name="departure_date" value="<?php echo "$departure_date"; ?>" required>
    <input type="time" name="departure_time" value="<?php echo "$departure_time"; ?>" required>

    <br>
    <label>Seats Available:</label>
    <input type="number" name="seats" value="<?php echo "$seats"; ?>" required>

    <br>
    <button type="submit"  name="submit">Update</button>
    <button type="submit" name="submit" onclick="history.back()">Back</button>
  </div>
  </form>
</div>
</body>
</html>