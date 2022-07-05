<?php
    include 'startsession.php';
    unset($_SESSION['user']);
    header('location: ../login.php');
?>