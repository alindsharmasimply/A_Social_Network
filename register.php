<?php 
session_start(); // Starts a session which allows to store the session values of variables

// This is how we establish a connection with the database
$con = mysqli_connect("localhost", "root", "", "social_network");
// Syntax: mysqli_connect(host, username, password, Database name)
// $con is a connection variable now

// To display any errors occured while establishing the connection
if (mysqli_connect_errno()) {
	echo "Failed to connect " , mysqli_connect_errno();
}

$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array(); // Hold error messages

// To check whether the submit button was pressed or not
if(isset($_POST['register_button']))
{
	// Registration form values

	$fname = strip_tags($_POST['reg_fname']); // Remove HTML tags
	$fname = str_replace(' ', '' , $fname); // Remove spaces
	$fname = ucfirst(strtolower($fname)); // Capitalize the first letter
	$_SESSION['reg_fname'] = $fname; // Stores first name into session variable

	$lname = strip_tags($_POST['reg_lname']); // Remove HTML tags
	$lname = str_replace(' ', '' , $lname); // Remove spaces
	$lname = ucfirst(strtolower($lname)); // Capitalize the first letter
	$_SESSION['reg_lname'] = $lname; // Stores last name into session variable


	$em = strip_tags($_POST['reg_email']); // Remove HTML tags
	$em = str_replace(' ', '' , $em); // Remove spaces
	$em = ucfirst(strtolower($em)); // Capitalize the first letter
	$_SESSION['reg_email'] = $em; // Stores email into session variable


	$em2 = strip_tags($_POST['reg_email2']); // Remove HTML tags
	$em2 = str_replace(' ', '' , $em2); // Remove spaces
	$em2 = ucfirst(strtolower($em2)); // Capitalize the first letter
	$_SESSION['reg_email2'] = $em2; // Stores email2 into session variable


	$password = strip_tags($_POST['reg_password']);

	$password2 = strip_tags($_POST['reg_password2']);

	// Current date
	$date = date("Y-m-d");

	// Check if both entered emails match or not
	if ($em == $em2) {
		if (filter_var($em, FILTER_VALIDATE_EMAIL)) // Checks the email format
		{
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//Check if email already exists

			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'"); // Selects all existing matching emails
			$num_rows = mysqli_num_rows($e_check); // Returns count of number of emails/rows
			if ($num_rows > 0) {
				array_push($error_array, "Email already in use<br>") ;
			}
		}
		else
		{
			array_push($error_array, "Invalid format<br>") ;
		}
	}
	else
	{
		array_push($error_array, "Emails don't match<br>") ;
	} 
	if (strlen($fname) > 25 || strlen($fname) < 2 ) 
	{
		array_push($error_array, "Your first name must be between 2 and 25 letters<br>");
	}
	if (strlen($lname) > 25 || strlen($lname) < 2)
	{
		array_push($error_array, "Your last name must be between 2 and 25 letters<br>");
	}
	if ($password != $password2) 
	{
		array_push($error_array, "Your passwords do not match<br>");
	}
	else
	{
		if (preg_match('/[^A-Za-z0-9]/', $password)) // Password pattern checked using regular expressions
		 {
			array_push($error_array,"Your password should only contain english numbers and letters<br>");
		}
	}

	if (empty($error_array)) // If there is no error
	{
		$password = md5($password); // Encrypt password before sending to database

		// Generate username by concatenating first name and last name
		$username = strtolower($fname."_".$lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");

		$i = 0;
		// Check if a username already exists
		while (mysqli_num_rows($check_username_query) != 0) {
			$i++;
			$username = $username."_".$i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
		}
		// Profile pic assignment
		$rand = rand(1, 2);
		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
		else
			$profile_pic = "assets/images/profile_pics/defaults/head_wisteria.png";

		// Finally inserting the values in our database
		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

		array_push($error_array, "<span style='color: #14C800;'> You are all set! Go ahead and Log-In </span><br>");

		// Clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}
}
?>
<html>
<head>
	<title>Welcome to Amity Social Network</title>
</head>
<body>

<!--Login and Registration form for users-->
	<form action="register.php" method="POST">
		<label for="reg_fname"><b>First Name</b></label>
		<input type="text" name="reg_fname" placeholder="First Name" value=
		"<?php
		{ // Restoring the input fields in case if the session gets failed
			if(isset($_SESSION['reg_fname']))
			{
				echo $_SESSION['reg_fname'];
			}
		}
		?>" required>
		<br>
		<?php // Display error message if any
		if (in_array("Your first name must be between 2 and 25 letters<br>", $error_array)) {
			echo "Your first name must be between 2 and 25 letters<br>";
		}
		?>
		<label for="reg_lname"><b>Last Name</b></label>
		<input type="text" name="reg_lname" placeholder="Last Name" value=
		"<?php
		{// Restoring the input fields in case if the session gets failed
			if(isset($_SESSION['reg_lname']))
			{
				echo $_SESSION['reg_lname'];
			}
		}
		?>" required>
		<br>
		<?php // Display error message if any
		if (in_array("Your last name must be between 2 and 25 letters<br>", $error_array)) {
			echo "Your last name must be between 2 and 25 letters<br>";
		}
		?>
		<label for="reg_email"><b>Email</b></label>
		<input type="email" name="reg_email" placeholder="Email" value=
		"<?php
		{// Restoring the input fields in case if the session gets failed
			if(isset($_SESSION['reg_email']))
			{
				echo $_SESSION['reg_email'];
			}
		}
		?>" required>
		<br>

		<label for="reg_email2"><b>Confirm Email</b></label>
		<input type="email" name="reg_email2" placeholder="Confirm Email" value=
		"<?php
		{ // Restoring the input fields in case if the session gets failed
			if(isset($_SESSION['reg_email2']))
			{
				echo $_SESSION['reg_email2'];
			}
		}
		?>" required>
		<br>
		<?php // Display error messages if any
		if (in_array("Email already in use<br>", $error_array)) {
			echo "Email already in use<br>";
		}

		else if (in_array("Invalid format<br>", $error_array)) {
			echo "Invalid format<br>";
		}

		else if (in_array("Emails don't match<br>", $error_array)) {
			echo "Emails don't match<br>";
		}
		?>
		<label for="reg_password"><b>Password</b></label>
		<input type="password" name="reg_password" placeholder="Password" required>
		<br>
		<label for="reg_password2"><b>Confirm Password</b></label>
		<input type="password" name="reg_password2" placeholder="Confirm Password" required>
		<br>
		<?php // Display error messages if any
		if (in_array("Your passwords do not match<br>", $error_array)) {
			echo "Your passwords do not match<br>";
		}

		else if (in_array("Your password should only contain english numbers and letters<br>", $error_array)) {
			echo "Your password should only contain english numbers and letters<br>";
		}
		?>
		<input type="submit" name="register_button" value="Register">
		<br>

		<?php
		if (in_array("<span style='color: #14C800;'> You are all set! Go ahead and Log-In </span><br>", $error_array)) {
			echo "<span style='color: #14C800;'> You are all set! Go ahead and Log-In </span><br>";
		}
		?>

	</form>

</body>
</html>