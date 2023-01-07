<?php
session_start();
$connectionErr = false;
// Connect to the database and return the database object
function connect() {
  // Set the hostname for CodeCademy's platform
  $hostname = 'localhost';

  // Set the database name
  $dbname = 'minor_thoughts';

  // Set the username and password with permissions to the database
  $username = 'roman';
  $password = '12345';
  
  // Create the DSN (data source name) by combining the database type, hostname and dbname
  $dsn = "mysql:host=$hostname;dbname=$dbname";

  // Create the try/catch blocks here
  try {
    return new PDO($dsn, $username, $password);
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

