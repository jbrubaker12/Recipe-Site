<?php
// Database connection parameters
$host = '127.0.0.1'; // IP address
$dbname = 'recipes'; // Database name
$user = 'test'; // Replace with your database username
$pass = 'test'; // Replace with your database password

// Create a new PDO instance
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

// Set the PDO error mode to exception
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>