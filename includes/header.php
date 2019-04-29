<?php 
require 'config/config.php';
// Check if the user is logged in
if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
}
else // Take the user to the landing page
{
	header("Location: register.php");
}
 ?>
<html>

<head>
    <title>Welcome to Ammunity</title>
</head>

<body>