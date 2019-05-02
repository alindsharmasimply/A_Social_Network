<?php 
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");


if (isset($_POST['post'])) {
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
}


//session_destroy(); // Destroys the older session i.e., logs out
 ?>

<div class="user_details column">
	<!--To display the profile pic, the location of which is extracted from the database-->
	<a href="<?php echo $userLoggedIn; ?>" >
		<img src="<?php echo $user['profile_pic']; ?>">
	</a>
	<div class="user_details_left_right">
	<a href="<?php echo $userLoggedIn; ?>">
		<?php
		echo $user['first_name'] . " " . $user['last_name'];
		?>
	</a>
	<br>
	<?php
	echo "Posts: " . $user['num_posts'] . "<br>";
	echo "Likes: " . $user['num_likes'];
	?>
</div>
</div>
<div class="main_column column">
	<form class="post_form" action="index.php" method="POST">
		<textarea name="post_text" id="post_text" placeholder="Got Something to say ?"></textarea>
		<input type="submit" name="post" id="post_button" value="Post">
		<hr>
	</form>
	<?php

	// Creating the User class object in order to call its functions
	$user_obj = new User($con, $userLoggedIn);
	echo $user_obj->getFirstAndLastName();

	 ?>
</div>
</div>
</body>
</html>