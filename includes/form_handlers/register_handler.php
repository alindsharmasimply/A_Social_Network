<?php 
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