<?php 
require 'config/config.php';
// Check if the user is logged in
if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];

	// To store the user details in an array for any future use
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else // Take the user to the landing page
{
	header("Location: register.php");
}
 ?>
<html>

<head>
    <title>Welcome to Ammunity</title>

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<body>

	<div class="top-bar">
		<div class="logo">
			<a style="color: #e67e22" href="index.php">Ammunity!</a>
		</div>

		<nav> <!--Navigation items-->
			<a href="#">
			<?php
				echo $user['first_name']; 
			?>
			</a>
			<a href="#"><i class="fas fa-home"></i></a>
			<a href="#"><i class="fas fa-envelope"></i></a>
			<a href="#"><i class="far fa-bell"></i></a>
			<a href="#"><i class="fas fa-users"></i></a>
			<a href="#"><i class="fas fa-cog"></i></a>
		</nav>
	</div>