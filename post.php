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
</head>
<body>

	<!-- Navigation -->
	<header>
	<?php $page = 'notification';include 'includes/navbar-fixed.php'; ?>
	<?php $page = 'notification';include 'includes/navbar-text.php'; ?>
	</header>

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

        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        else {
            $id = 0;
        }

        ?>

        <!-- Start Middle Section -->
        <div class="col-md-6" id="middle-section">

		<!-- Display Posts and Loading GIF -->
    		<div class="posts_area">
                <?php
                    $post = new Post($con, $userLoggedIn);
                    $post->getSinglePost($id);
                ?>
            </div>

        </div>
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
