<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");


if(isset($_POST['cancel'])) {
	header("Location: settings.php");
}

if(isset($_POST['close_account'])) {
	$close_query = mysqli_query($con, "UPDATE users SET user_closed='yes' WHERE username='$userLoggedIn'");
	session_destroy();
	header("Location: register.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<title>Settings | Twitbook</title>
</head>

<body id="settings_body">

<!-- Start Settings section -->
<div id="settings" class="offset">

	<!-- Navigation -->
	<header>
	<?php $page = 'settings';include 'includes/navbar.php'; ?>
	</header>

	<div class="container mt-5 pt-5">
		<div class="jumbotron" id="account_settings_container">

			<h1 class="display-6" id="setting_headingtext">Close Account</h1>
			<hr class="socket"><br>

			Are you sure you want to close your account?<br><br>
			Closing your account will hide your profile and all your activity from other users.<br><br>
			You can re-open your account at any time by simply logging in.<br><br>

			<form action="close_account.php" method="POST">
				<input class="btn btn-outline-light btn-sm shadow-sm" type="submit" name="close_account" id="close_account" value="Close Account" class="danger settings_submit">
				<input class="btn btn-outline-light btn-sm shadow-sm" type="submit" name="cancel" id="update_details" value="Cancel" class="info settings_submit">
			</form>

		</div>
	</div> <!-- End Container -->

</div>
<!-- End Settings section -->

<!-- Top Scroll -->
<a href="#settings" class="top-scroll">
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
