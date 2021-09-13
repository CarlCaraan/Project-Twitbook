<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<title> Profile | Twitbook </title>
</head>

<body id="profile_body">

<!-- Start Profile section -->
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

	<!-- Start Fixed Background IMG Dark -->
	<div class="fixed-background" id="toggle-dark">

		<div class="light">
			<div class="narrow center">
				<a href="upload.php">
					<img src="<?php echo $user_array['profile_pic']; ?>" class="rounded-circle shadow-sm animate__animated animate__fadeInDown" width="200" alt=""><br>
				</a>
				<a href="upload.php" id="upload_icon_tag">
					<i class="fas fa-upload position-absolute animate__animated animate__fadeInDown shadow-lg" id="upload_icon" data-fa-transform="grow-10"></i>
				</a>
				<h2><?php echo $user_array['first_name'] . " " . $user_array['last_name']; ?></h2>
			 </div> <!-- End narrow -->
		</div> <!-- End of Light -->

			<div class="fixed-wrap">
				<div id="fixed-2">
				</div>
			</div>

	</div>
	<!-- End Fixed Background IMG Dark -->

	</header>
	<!-- End Profile Header -->


	<!-- Navigation -->
	<?php $page = 'profile';include 'includes/navbar_sticky.php'; ?>

	<?php
	if(isset($_POST['remove_friend'])) {
		$user = new User($con, $userLoggedIn);
		$user->removeFriend($username);
	}

	if(isset($_POST['add_friend'])) {
		$user = new User($con, $userLoggedIn);
		$user->sendRequest($username);
	}
	if(isset($_POST['respond_request'])) {
		header("Location: requests.php");
	}
	?>

	<!-- Start Section Content -->
	<section>
	<article>

		<div class="container">

		<div class="row">

			<!-- Start Intro Section -->
			<div class="col-lg-4 animate__animated animate__fadeInLeft" id="col-wrapper1">

				<label for="post_text" id="labeltitle">Intro</label><br>
				<div id="icon_wrapper"><i class="fas fa-file-alt"></i></div>
				<div id="text_wrapper"><?php echo "Posts: " . $user_array['num_posts']; ?></div><br>

				<div id="icon_wrapper"><i class="fas fa-flag"></i></div>
				<div id="text_wrapper"><?php echo "Likes: " . $user_array['num_likes']; ?></div><br>

				<div id="icon_wrapper"><i class="fas fa-user-friends"></i></div>
				<div id="text_wrapper"><?php echo "Friends: " . $num_friends; ?></div><br>

				<?php
				//Get Mutual Friends
				$logged_in_user_obj = new User($con, $userLoggedIn);

				if($userLoggedIn != $username) {
					echo '<div id="icon_wrapper"><i class="fas fa-users"></i></div>';
					echo '<div id="text_wrapper">&nbsp;Mutual Friends: ' . $logged_in_user_obj->getMutualFriends($username);
					echo '</div>';
				}
				?>

				<hr class="socket">

				<!-- Add Remove Respond Button -->
				<form class="center" action="<?php echo $username; ?>" method="POST">

				<?php
				$profile_user_obj = new User($con, $username);
				if($profile_user_obj->isClosed()) {
					header("Location: user_closed.php");
				}

				$logged_in_user_obj = new User($con, $userLoggedIn);

				if($userLoggedIn != $username) {

					if($logged_in_user_obj->isFriend($username)) {
						echo '<input type="submit" name="remove_friend" class="btn btn-outline-light btn-sm shadow-sm" value="Unfriend"></input><hr class="socket">';
					}
					else if ($logged_in_user_obj->didReceiveRequest($username)) {
						echo '<input type="submit" name="respond_request" class="btn btn-outline-light btn-sm shadow-sm" value="Respond to Request"><hr class="socket"></input>';
					}
					else if ($logged_in_user_obj->didSendRequest($username)) {
						echo '<input type="submit" name="" class="btn btn-outline-light btn-sm shadow-sm" value="Request Sent"><hr class="socket"></input>';
					}
					else
						echo '<input type="submit" name="add_friend" class="btn btn-outline-light btn-sm shadow-sm" value="Add Friend"><hr class="socket"></input>';

				}
				?>
				</form>

				<!-- Open Modal -->
				<div class="center">
					<button type="button" class="btn btn-outline-light btn-sm shadow-sm p-3 m-3" data-toggle="modal" data-target="#myModal">
						Post Something.
					</button>
				</div>



			</div>
			<!-- End Intro Section -->


			<!-- Start Modal -->
			<div class="modal fade" id="myModal">
			    <div class="modal-dialog modal-xl">
			        <div class="modal-content">

			        <!-- Modal Header -->
			        <div class="modal-header">
				        <h4 class="modal-title">Create Post:</h4>
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>

			        <!-- Modal body -->
			        <div class="modal-body">
			            <form class="profile_post" action="" method="POST">

			            <div class="form-group">
			            	<textarea class="form-control border border-dark" rows="5" id="post_text" name="post_body" placeholder="What's on your mind, <?php echo $user['first_name'] ?> ?"></textarea>
							<input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
							<input type="hidden" name="user_to" value="<?php echo $username; ?>">
			            </div>

				        </form>
			        </div>

			        <!-- Modal footer -->
			        <div class="modal-footer">
			            <input type="submit" class="btn btn-outline-light btn-sm shadow-sm float-right" name="post_button" id="submit_profile_post" value="Tweet"></input>
				        <button type="button" class="btn btn-outline-light btn-sm shadow-sm" data-dismiss="modal">Close</button>
			        </div>

			        </div>
			    </div>
			</div>
			<!-- End Modal -->


			<!-- Ajax Script limit post -->
			<script>
				var userLoggedIn = '<?php echo $userLoggedIn; ?>';
				var profileUsername = '<?php echo $username; ?>'

				$(document).ready(function() {

					$('#loading').show();

					//Original ajax request for loading first posts
					$.ajax({
						url: "includes/handlers/ajax_load_profile_posts.php",
						type: "POST",
						data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
						cache:false,

						success: function(data) {
							$('#loading').hide();
							$('.posts_area').html(data);
						}
					});

					$(window).scroll(function() {
						var height = $('.posts_area').height(); //Div containing posts
						var scroll_top = $(this).scrollTop();
						var page = $('.posts_area').find('.nextPage').val();
						var noMorePosts = $('.posts_area').find('.noMorePosts').val();

						  if((window.innerHeight+window.scrollY>=document.body.offsetHeight-100) && noMorePosts == 'false') {
							$('#loading').show();

							var ajaxReq = $.ajax({
								url: "includes/handlers/ajax_load_profile_posts.php",
								type: "POST",
								data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
								cache:false,

								success: function(response) {
									$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage
									$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage

									$('#loading').hide();
									$('.posts_area').append(response);
								}
							});

						} //End if

						return false;

					}); //End (window).scroll(function())


				});
				</script>

			<!-- Start Middle Section -->
			<div class="col-lg-7 animate__animated animate__fadeInRight" id="middle-section">

				<!-- Display Posts and Loading GIF -->
				<div class="posts_area"></div>
				<img id="loading" src="assets/images/icons/loading.gif">

			</div>
			<!-- End Middle Section -->

		</div> <!-- End Row -->

		</div> <!-- End Container -->

	</article>
	</section>
	<!-- End Section Content -->



</div>
<!-- End Profile section -->


<!-- Top Scroll -->
<a href="#profile" class="top-scroll">
	<i class="fas fa-angle-up"></i>
</a>
<!-- End of Top Scroll -->


<?php include 'includes/scripts.php'; ?>

</body>
</html>
