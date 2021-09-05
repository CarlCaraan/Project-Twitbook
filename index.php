<?php
require("config/config.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
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

	<!-- Navigation -->
	<header>
	<?php $page = 'home';include 'includes/navbar.php'; ?>
	</header>

<?php
    if(isset($_POST['post'])){
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
}
?>

    <!-- Start Three Section -->
	<section>
    <div class="container-fluid" id="content">

 	<div class="row">
        <!-- Start Left Section-->
        <div class="col-md-3" id="left-section">

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
        </div>

        </div>
        <!-- End Left Section -->

        <!-- Start Middle Section -->
        <div class="col-md-6" id="middle-section">

        <div id="post-container">
          <form action="index.php" method="POST">
            <div class="form-group">
              <label for="post_text">Create Post:</label>
              <textarea class="form-control" rows="5" id="post_text" name="post_text" placeholder="What's on your mind, <?php echo $user['first_name'] ?> ?"></textarea>
            </div>
            <input type="submit" class="btn btn-outline-light btn-sm shadow-sm float-right" name="post" id="post_button" value="Tweet"></input>
          </form>
        </div>

	    <!-- Autogrow Text Area -->
	    <script>
	        var textarea = document.querySelector('textarea');

	        textarea.addEventListener('keydown', autosize);

	        function autosize(){
	          var el = this;
	          setTimeout(function(){
	            el.style.cssText = 'height:auto; padding:0';
	            // for box-sizing other than "content-box" use:
	            // el.style.cssText = '-moz-box-sizing:content-box';
	            el.style.cssText = 'height:' + el.scrollHeight + 'px';
	          },0);
	        }
	    </script>

		<!-- Display Posts and Loading GIF -->
		<div class="posts_area"></div>
		<img id="loading" src="assets/images/icons/loading.gif">

        </div>

		<!-- Ajax Script limit post -->
		<script>
		var userLoggedIn = '<?php echo $userLoggedIn; ?>';

		$(document).ready(function() {

			$('#loading').show();

			//Original ajax request for loading first posts
			$.ajax({
				url: "includes/handlers/ajax_load_posts.php",
				type: "POST",
				data: "page=1&userLoggedIn=" + userLoggedIn,
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

				if($(window).scrollTop() == $(document).height() - $(window).height() && noMorePosts == 'false') {
					$('#loading').show();

					var ajaxReq = $.ajax({
						url: "includes/handlers/ajax_load_posts.php",
						type: "POST",
						data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
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
        <!-- End Middle Section -->


        <!-- Start Right Section -->
        <div class="col-md-3" id="right-section">

        <div class="content position-fixed" id="content_certificate">

        <div class="row">

        	<div class="col-lg-12">

			<!-- Heading Text -->
    		<div class="os-animation" data-animation="fadeInRight">
        	    <label for="post_text">Ads:</label>
			</div>

				<!-- Start Animation -->
        		<div class="os-animation" data-animation="fadeInRight" data-delay=.1s>
        		<div id="team-slider" class="owl-carousel owl-theme">

					<div class="card center">
						<img class="card-img-top" src="assets/images/certificate/cert1.jpg" alt="">
					</div>

					<div class="card center">
						<img class="card-img-top" src="assets/images/certificate/cert2.jpg" alt="">
					</div>

					<div class="card center">
						<img class="card-img-top" src="assets/images/certificate/cert3.jpg" alt="">
					</div>

					<div class="card center">
						<img class="card-img-top" src="assets/images/certificate/cert4.jpg" alt="">
					</div>

        		</div>
			</div> <!-- End Animation -->
        	</div> <!-- End col-12 -->

        </div> <!-- End Row -->

        </div>

        </div>
        <!-- End Right Section -->


    </div> <!-- End Row -->

	</div> <!-- End Container-Fluid -->
	</section>
    <!-- End The Three Section -->

</div>
<!-- End Home section -->


<!--- Top Scroll -->
<a href="#home" class="top-scroll">
	<i class="fas fa-angle-up"></i>
</a>
<!--- End of Top Scroll -->


<?php include 'includes/scripts.php'; ?>

</body>
</html>
