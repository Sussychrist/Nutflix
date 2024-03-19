<?php
$host ="localhost";
$username ="root";
$password= "";
$database="nutflix";
// create database connection
$con = mysqli_connect("$host", "$username", "$password", "$database");

// check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// use $con variable in code below
?>

