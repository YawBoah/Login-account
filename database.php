<?php

$hostName ="localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "dummy";
$link = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if ($link) {
    die("Something went wrong");
}



?>