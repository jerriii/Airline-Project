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

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE FROM candidate WHERE id=$id";
        $result = mysqli_query($db, $sql);
        if($result) {
            header('location:candidate.php');
        }
        else
        {
            die(mysqli_error($db));
        }
    }

?>