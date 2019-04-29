<?php 
if (isset($_POST['login_button'])) {
	
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); // Make sure that the format is correct

	$_SESSION['log_email'] = $email;

	$password = md5($_POST['log_password']); // Since md5() encrypts and stores two same passwords in the same way

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) // If the account is found
	{
		$row = mysqli_fetch_array($check_database_query); // Stores an array of all the selection from the database
		$username = $row['username'];

		// Re-open any closed account
		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND user_closed = 'yes'");
		if (mysqli_num_rows($user_closed_query) == 1) {
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email'");
		}

		$_SESSION['username'] = $username; // To Log-in a user
		header("Location: index.php"); // To redirect to page index.php after the log-in is done
		exit();
	}
	else
	{
		array_push($error_array, "Email or password was incorrect.<br>");
	}
}
 ?>