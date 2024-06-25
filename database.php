<?php
$hostName = "localhost";
$dbUser ="root";
$dbPassword ="";
$dbName="registration";

$connection = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);
 if (!$connection) {
    die("Something went wrong!");
 }


?>