<?php 

//to see db go to localhost.phpmyadmin/index.php

//used to register users for the site by adding to db to log in later

$servername = "localhost";
$username = "root";
$password = "";
$database = "google_users";
$port = 3307;

//Create connection since we changed the port num had to add it here
$google_conn = new mysqli($servername, $username, $password, $database, $port);

if (!$google_conn) {
    echo "Connection Failed";
}
?>