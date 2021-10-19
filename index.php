<?php
require("config/config.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");
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
	<?php $page = 'home';include 'includes/navbar-fixed.php'; ?>
	<?php $page = 'home';include 'includes/navbar-text.php'; ?>
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

        <div class="content position-fixed" id="left_width">

			<a id="left_alinks" href="<?php echo $userLoggedIn; ?>">
				<div id="left_links_container">
					<div id="icon_wrapper"><img class="rounded-circle w-100"  src="<?php echo $user['profile_pic'] ?>" alt=""></i></div>
					<div id="text_wrapper"><?php echo $user['first_name'] . " " . $user['last_name']; ?></div><br>
				</div>
			</a>

			<a id="left_alinks" href="<?php echo $userLoggedIn; ?>">
				<div id="left_links_container">
					<div id="icon_wrapper"><i class="fas fa-file-alt"></i></div>
					<div id="text_wrapper"><?php echo "Posts: " . $user['num_posts']; ?></div><br>
				</div>
			</a>

			<a id="left_alinks" href="<?php echo $userLoggedIn; ?>">
				<div id="left_links_container">
					<div id="icon_wrapper"><i class="fas fa-thumbs-up"></i></div>
					<div id="text_wrapper"><?php echo "Likes: " . $user['num_likes']; ?></div>
				</div>
			</a><br>


			<hr class="socket">

			<!-- Start Trends -->
			<div class="trends mt-3 mb-4">
				<h4>Trends for you</h4>

				<?php
				$query = mysqli_query($con, "SELECT * FROM trends ORDER BY hits DESC LIMIT 9");

				while($row = mysqli_fetch_array($query)) {
					$word = $row['title'];
					$word_dot = strlen($word) >= 14 ? "..." : "";

					$trimmed_word = str_split($word, 14);
					$trimmed_word = $trimmed_word[0];

					echo "<div class='pl-1'>";
					echo "#" . $trimmed_word . $word_dot;
					echo "<br></div>";
				}


				?>
			</div>
			<!-- End Trends -->

			<hr class="socket">

			<!-- Start Quote API -->
		    <div class="quote-container mt-4" id="quote-container">
		        <!-- Quote -->
		        <div class="quote-text">
		            <i class="fas fa-quote-left"></i>
		            <span id="quote"></span>
		        </div>
		        <!-- Author -->
		        <div class="quote-author">
		            <span id="author"></span>
		        </div>
		        <!-- Buttons -->
		        <div class="button-container">
		            <button class="twitter-button" id="twitter" title="Tweet This!">
		                <i class="fab fa-twitter" id="twitter_logo"></i>
		            </button>
		            <button id="new-quote">New Quote</button>
		        </div>
		    </div>
		    <!-- Loader -->
		    <div class="loader mx-auto mt-5" id="loader"></div>
			<!-- End Quote API -->

        </div>

        </div>
        <!-- End Left Section -->

        <!-- Start Middle Section -->
        <div class="col-md-6" id="middle-section">

        <div id="post-container">
          <form action="index.php" method="POST">
            <div class="form-group">
              <label for="post_text" id="labeltitle">Create Post:</label>
              <textarea class="form-control" rows="5" id="post_text" name="post_text" placeholder="What's on your mind, <?php echo $user['first_name'] ?> ?"></textarea>
            </div>
            <input type="submit" class="btn btn-outline-light btn-sm shadow-sm float-right" name="post" value="Tweet"></input>
          </form>
        </div>

	    <!-- Autogrow Textarea -->
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

        <div class="content position-fixed" id="certificate_container">

        <div class="row">

        	<div class="col-lg-12">

			<!-- Heading Text -->
    		<div class="os-animation" data-animation="fadeInRight">
        	    <label for="post_text" id="labeltitle">Ads:</label>
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

					<div class="card center">
						<img class="card-img-top" src="assets/images/certificate/cert5.jpg" alt="">
					</div>

					<div class="card center">
						<img class="card-img-top" src="assets/images/certificate/cert6.png" alt="">
					</div>

					<div class="card center">
						<img class="card-img-top" src="assets/images/certificate/cert7.jpg" alt="">
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


<!-- Top Scroll -->
<a href="#home" class="top-scroll">
	<i class="fas fa-angle-up"></i>
</a>
<!-- End of Top Scroll -->

<!-- Start Internet Notification Popup Message -->
<div class="connections">
	<div class="connection offline">
		<i class="material-icons wifi-off">wifi_off</i>
		<p>you are currently offline</p>
		<a href="#" class="refreshBtn">Refresh</a>
		<i class="material-icons close">close</i>
	</div>
	<div class="connection online">
		<i class="material-icons wifi">wifi</i>
		<p>your Internet connection was restored</p>
		<i class="material-icons close">close</i>
	</div>
</div>
<!-- End Internet Notification Popup Message -->


<?php include 'includes/scripts.php'; ?>

</body>
</html>
