<?php
$servername = "localhost";
$username = "id8941235_rafi";
$password = "unisbank";
$dbname = "id8941235_akademik";

$connection = mysqli_connect($servername, $username, $password, $dbname);
if (!$connection){
        die("Connection Failed:".mysqli_connect_error());
    }
?>