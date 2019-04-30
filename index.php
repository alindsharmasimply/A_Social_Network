<?php 
include("includes/header.php");
//session_destroy(); // Destroys the older session i.e., logs out
 ?>

<div class="user_details column">
	<!--To display the profile pic, the location of which is extracted from the database-->
	<a href="#" >
		<img src="<?php echo $user['profile_pic']; ?>">
	</a>
	<div class="user_details_left_right">
	<a>
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
</div>
</body>
</html>