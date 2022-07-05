<?php

function e($val) {
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

?>