<?php 

// Inclusion of the database configuration file
require 'config/config.php';

// Inclusion of the registeration form code
require 'includes/form_handlers/register_handler.php';

// Inclusion of the login form code
require 'includes/form_handlers/login_handler.php';

?>
<html>
<head>
	<title>Welcome to Amity Social Network</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
</head>

<body>
	<div class="wrapper">

	<div class="login_box">
		<div class="login_header">
			<h1>Welcome to Ammunity</h1>
			<span style="color: #e67e22">Login or sign up below!</span>
		</div>
		<!--Login form for users-->
		<form action="register.php" method="POST">
			<input type="email" name="log_email" placeholder="Email Address" value=
			"<?php
			{ // Restoring the input fields in case if the session gets failed
				if(isset($_SESSION['log_email']))
				{
					echo $_SESSION['log_email'];
				}
			}
			?>" required>
			<br>
			<input type="password" name="log_password" placeholder="Password">
			<br>
			
			<?php if (in_array("Email or password was incorrect.<br>", $error_array)) {
				echo "Email or password was incorrect.<br>";
			} ?>
			<input type="submit" name="login_button" value="Login">
			<br>
		</form>

<!--Registration form for users-->
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
</div>
</div>
</body>

</html>