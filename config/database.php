<?php
// create credentials
$server = "localhost";
$user = "root";
$passwd = "";
$database = "canteen";

// connection to the database
$connect = mysqli_connect($server, $user, $passwd, $database);
if(!$connect){
    echo "Could not connect to the database";
}
?>