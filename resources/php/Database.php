<?php

// initialize variables to hold database connection parameters.

$username = 'root';

$dbconn = 'mysql:host=127.0.0.1:3307; dbname=registration';

$password = '';

try {

  // Create an instance of the PDO class with the required parameters.
  $conn = new PDO($dbconn, $username, $password);

  // Set PDO error mode to exception.
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Display success message.
  //echo "Connected to the Database!";

} catch (PDOException $ex) {

  // Display error message.
  echo "Database Connection Failed! Check your Connection." . $ex->getMessage();

}