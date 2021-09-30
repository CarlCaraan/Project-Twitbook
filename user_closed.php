<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<title> 404 | Twitbook </title>
</head>

<body>
<?php $page = 'profile';include 'includes/navbar_sticky.php'; ?>

<div class="container">
    <div class="narrow center"><br>
        <h2>Sorry, this page isn't available</h2><br>
        <h4>The link you followed may be broken, or the page may have been removed.</h4>

        <pre>

            <!-- add extra spacing -->
			<div class="pr-5">
            	<img src="assets/images/no_content.png" class="pr-5 mr-5"alt=""><br>
			</div>
            <!-- add extra spacing -->

		</pre>
            <a href="index.php">Go back to home page.</a>
    </div>
</div>

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
