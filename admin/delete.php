<?php
include "../utils/database.php";

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE FROM flights WHERE id=$id";
        $result = mysqli_query($db, $sql);
        if($result) {
            header('location:display.php');
        }
        else
        {
            die(mysqli_error($db));
        }
    }

    ?>