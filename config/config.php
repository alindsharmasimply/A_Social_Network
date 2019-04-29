<?php

ob_start(); // Starts the output buffering
// Basically stores the output of the php code in an internal buffer

session_start(); // Starts a session which allows to store the session values of variables


$timezone = date_default_timezone_set('Asia/Kolkata');
// This is how we establish a connection with the database
$con = mysqli_connect("localhost", "root", "", "social_network");
// Syntax: mysqli_connect(host, username, password, Database name)
// $con is a connection variable now

// To display any errors occured while establishing the connection
if (mysqli_connect_errno()) {
	echo "Failed to connect " , mysqli_connect_errno();
}
 ?>