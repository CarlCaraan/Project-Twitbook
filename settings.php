<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");
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
			<h1 class="display-6 ml-2" id="setting_headingtext">Account Settings</h1>
			<hr class="socket">

			<div class="row">
				<div class="col-md-4">
					<a href="upload.php"><img src="<?php echo $user['profile_pic']; ?>" class="rounded shadow-sm" width="200" alt=""><br></a>
					<a href="upload.php" id="upload_icon_tag"><br><span class="ml-1" id="update_profilepic_text"> Upload new profile picture</span></a>
				</div>

				<?php
				//Settings Handler
				include("includes/form_handlers/settings_handler.php");

				$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
				$row = mysqli_fetch_array($user_data_query);

				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$email = $row['email'];
				?>

				<div class="col-md-8">
					<h4>Basic Information</h4>
					<form class="" action="settings.php" method="POST">
						<div class="form-group">
							First Name: <input class="form-control rounded" type="text" name="first_name" value="<?php echo $first_name; ?>">
							Last Name: <input class="form-control rounded" type="text" name="last_name" value="<?php echo $last_name; ?>">
							Email: <input class="form-control rounded" type="text" name="email" value="<?php echo $email; ?>">
							<input class="btn btn-outline-light btn-sm shadow-sm mt-2" type="submit" name="update_details" value="Update Details">
							<?php echo $message; ?>
						</div>
					</form>

					<hr class="socket">

					<h4>Change Password</h4>
					<form class="" action="settings.php" method="POST">
						<div class="form-group">
							Current Password: <input class="form-control rounded" type="password" name="old_password">
							New Password: <input class="form-control rounded" type="password" name="new_password_1">
							Confirm New Password: <input class="form-control rounded" type="password" name="new_password_2">
							<input class="btn btn-outline-light btn-sm shadow-sm mt-2" type="submit" name="update_password" value="Update Password">
							<?php echo $password_message; ?>
						</div>
					</form>

					<hr class="socket">

					<h4>Close Account</h4>
					<form class="" action="settings.php" method="POST">
						<input class="btn btn-outline-light btn-sm shadow-sm" type="submit" name="close_account" value="Close Account"><br><br>
					</form>
					<p>Note: Modify the value and click 'Update Details'</p>
				</div>
			</div>



	   		<p class="center" id="settings_copyright">&copy Carl Caraan 2021</p>
		</div>
	</div>




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
