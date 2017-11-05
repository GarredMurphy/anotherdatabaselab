<?php
function getDatabaseConnection()
{
    
$servername = "us-cdbr-iron-east-05.cleardb.net";
$username = "b10d78d16d1281";
$password = "12f943a2";
$dbname = "heroku_e746fa7e355c8e7";
// Create connection
$dbConn = new PDO("mysql:host=$servername; dbname = $dbname", $username, $password);
$dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $dbConn;
}
?>