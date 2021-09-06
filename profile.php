<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<!-- Display First Name on Profile Page title -->
	<title> Profile | Twitbook </title>
</head>

<body>

<!--- Start Profile section -->
<div id="profile" class="offset">

<?php
if(isset($_GET['profile_username'])) {
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

	$num_friends = (substr_count($user_array['friend_array'], ",")) -1;
}
?>

	<!-- Start Profile Header -->
	<header>
	<!--- Start Fixed Background IMG Dark -->
	<div class="fixed-background">

	<div class="dark">

		<div class="narrow center">
				<img src="<?php echo $user_array['profile_pic']; ?>" class="rounded-circle" width="200" alt=""><br>
				<?php echo $username; ?>
		</div> <!-- End narrow -->

	</div> <!-- End of Dark -->

		<div class="fixed-wrap">
			<div id="fixed-2">
			</div>
		</div>

	</div>
	<!--- End Fixed Background IMG Dark -->
	</header>
	<!-- End Profile Header -->


	<?php $page = 'profile';include 'includes/navbar_sticky.php'; ?>


	<!-- Start Section Content -->
	<section>
		<article>
			<div class="container">

			<div class="row">

				<!-- Start Intro Column -->
				<div class="col-lg-4" id="col-wrapper">
					<label id="post_text">Intro</label><br>

					<div id="icon_wrapper"><i class="fas fa-file-alt"></i></div>
					<div id="text_wrapper"><?php echo "Posts: " . $user_array['num_posts']; ?></div><br>

					<div id="icon_wrapper"><i class="fas fa-flag"></i></div>
					<div id="text_wrapper"><?php echo "Likes: " . $user_array['num_likes']; ?></div><br>

					<div id="icon_wrapper"><i class="fas fa-user-friends"></i></div>
					<div id="text_wrapper"><?php echo "Friends: " . $num_friends; ?></div>

				</div>
				<!-- End Intro Column -->

				<div class="col-lg-7" id="col-wrapper">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>

			</div> <!-- End Row -->

		</div> <!-- End Narrow -->
		</article>
	</section>
	<!-- End Section Content -->



</div>
<!--- End Profile section -->


<?php include 'includes/scripts.php'; ?>

</body>
</html>
