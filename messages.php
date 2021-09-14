<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<title>Message | Twitbook</title>
</head>

<body id="message_body">

<!-- Start Message section -->
<div id="home">

	<!-- Navigation -->
	<header>
	<?php $page = 'home';include 'includes/navbar-fixed.php'; ?>
	<?php $page = 'home';include 'includes/navbar-text.php'; ?>
	</header>

<?php
$message_obj = new Message($con, $userLoggedIn);

//Send message to previous user or to a new user
if(isset($_GET['u']))
    $user_to = $_GET['u'];
else {
    $user_to = $message_obj->getMostRecentUser();
    if($user_to = false)
        $user_to = 'new';
}

if($user_to != "new")
    $user_to_obj = new User($con, $user_to);
?>


    <!-- Start Two Section -->
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

        </div>

        </div>
        <!-- End Left Section -->


        <!-- Start Middle Section -->
        <div class="col-md-6" id="middle-section">

        <div id="post-container">
        <?php
        if($user_to != "new")
            echo "<h4>You and <a href='$user_to'>" . $user_to_obj->getFirstAndLastName() . "</a></h4><br>";
        ?>
        </div>

        </div>
        <!-- End Middle Section -->

    </div> <!-- End Row -->


	</div> <!-- End Container-Fluid -->
	</section>
    <!-- End The Three Section -->


</div>
<!-- End Message section -->


<!--- Top Scroll -->
<a href="#home" class="top-scroll">
	<i class="fas fa-angle-up"></i>
</a>
<!--- End of Top Scroll -->


<?php include 'includes/scripts.php'; ?>

</body>
</html>
