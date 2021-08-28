<?php
require 'config/config.php';
include 'includes/classes/User.php';
include 'includes/classes/Post.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<title>Twitbook</title>
</head>

<body>

<!-- Start Home section -->
<div id="home">

<?php $page = 'home';include 'includes/navbar.php'; ?>

<?php
    if(isset($_POST['post'])){
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
}
?>

    <!-- Start Three Section -->
    <div class="container-fluid" id="content">
      <div class="row">

        <!-- Start Left Section-->
        <div class="col-xl-3" id="left-section">
            <div class="content position-fixed">
                <div class="card" id="card"> <!-- Cards -->
                    <a href="<?php echo $userLoggedIn; ?>"> <!-- go to profile using .htaccess -->
                        <img class="card-img-top"  src="<?php echo $user['profile_pic'] ?>" alt="Card image" style="width:100%">
                    </a>
                    <div class="card-body" id="card-body">
                        <h4 class="card-title" id="card-title"><?php echo $user['first_name'] . " " . $user['last_name']; ?></h4>
                        <p class="card-text" id="card-text">Some example text some example text. Carl is Web Developer!</p>
                        <?php
                        echo "Posts: " . $user['num_posts'] . "<br>";
                        echo "Likes: " . $user['num_likes'];
                        ?>
                        <a href="<?php echo $userLoggedIn; ?>" class="btn btn-outline-light btn-lg shadow-sm">See Profile</a>
                    </div>
                </div> <!-- End Card -->
                <hr class="socket">
            </div> <!-- End Fixed Content -->

        </div>
        <!-- End Left Section -->

        <!-- Start Middle Section -->
        <div class="col-xl-6" id="middle-section">
            <div id="post-container">
              <form action="index.php" method="POST">
                <div class="form-group">
                  <label for="post_text">Create Post:</label>
                  <textarea class="form-control" rows="5" id="post_text" name="post_text" placeholder="What's on your mind, <?php echo $user['first_name'] ?> ?"></textarea>
                </div>
                <input type="submit" class="btn btn-outline-light btn-sm shadow-sm float-right" name="post" id="post_button" value="Tweet"></input>
              </form>
            </div>

			<?php

			$post = new Post($con, $userLoggedIn);
			$post->loadPostsFriends();

			?>

			<img id="loading" src="assets/images/icons/loading.gif">

        </div>

		<!-- Ajax Script limit post -->
		<script>
		var userLoggedIn = '<?php echo $userLoggedIn; ?>';

		//-- Start JQuery Function  --//
		$(document).ready(function(){
			$('#loading').show();

			//Original Ajax request for loading first post
			$.ajax({
				url: "includes/handlers/ajax_load_posts.php",
				type: "POST",
				data: "page=1&userLoggedIn=" + userLoggedIn,
				cache: false,
			}); //End $.ajax({


		}); //-- End JQuery Function --//
		</script>
        <!-- End Middle Section -->


        <!-- Start Right Section -->
        <div class="col-xl-3" id="right-section">
            <div class="content position-fixed">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br>
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>
        </div>
        <!-- End Right Section -->

      </div><!-- End Row -->

    </div>
    <!-- End The Three Section -->




</div>
<!-- End Home section -->







<?php include 'includes/scripts.php'; ?>

</body>
</html>
