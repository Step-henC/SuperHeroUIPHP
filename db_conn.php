<?php 

//to see db go to localhost.phpmyadmin/index.php

//we have users 

//marshaMellow, IlikeSmores
//dr.Teeth, mayhem
//poohBear, honey
//himButler, buckets

$servername = "localhost";
$username = "root";
$password = "";
$database = "superloginin";
$port = 3307;

//Create connection since we changed the port num had to add it here
$connection = new mysqli($servername, $username, $password, $database, $port);

if (!$connection) {
    echo "Connection Failed";
}
?>