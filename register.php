<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Welcome to Twitter Clone</title>
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<link rel="stylesheet" href="bootstrap-4.6.0-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="assets/css/fixed.css">
</head>
<body>

<!-- Start Form Section -->
<div class="container" id="container-prop">
	<div class="control">

	<!-- Login Form -->
	<form class="" action="register.php" method="POST">
		<h3>Login or Sign Up</h3>

		<div class="form-group">
		<label for="log_email">Email:</label>
			<input type="email" class="form-control" name="log_email" placeholder="Email Address" value="<?php
			if(isset($_SESSION['log_email'])) { //Start the SESSION to remain users input
				echo $_SESSION['log_email'];
			} ?>" required>
		</div>

		<div class="form-group">
			<label for="log_password">Password:</label>
			<input class="form-control" type="password" name="log_password" placeholder="Password">
		</div>

		<div class="center">
			<input class="btn btn-outline-light btn-lg" type="submit" name="login_button" value="Login"><br>
			<?php if(in_array("Email or password was incorrect<br>", $error_array)) echo "Email or password was incorrect<br>"; ?><!-- Show Error Message -->
		</div>
	</form>

	<!-- Register Form -->
	<form  class"" action="register.php" method="POST">

		<div class="form-group">
			<label for="reg_fname">Full Name:</label>
			<input class="form-control" type="text" name="reg_fname" placeholder="First Name" value="<?php
			if(isset($_SESSION['reg_fname'])) { //Start the SESSION to remain users input
				echo $_SESSION['reg_fname'];
			} ?>" required>
			<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
		</div>

		<div class="form-group">
			<input class="form-control" type="text" name="reg_lname" placeholder="Last Name" value="<?php
			if(isset($_SESSION['reg_lname'])) {
				echo $_SESSION['reg_lname'];
			} ?>" required>
			<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>
		</div>


		<div class="form-group">
			<label for="reg_email">Email:</label>
			<input class="form-control" type="email" name="reg_email" placeholder="Email" value="<?php
			if(isset($_SESSION['reg_email'])) {
				echo $_SESSION['reg_email'];
			} ?>" required>
		</div>


		<div class="form-group">
			<input class="form-control" type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
			if(isset($_SESSION['reg_email2'])) {
				echo $_SESSION['reg_email2'];
			} ?>" required>
			<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
			else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
			else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>
		</div>


		<div class="form-group">
			<label for="reg_password">Password:</label>
			<input class="form-control" type="password" name="reg_password" placeholder="Password" required>
		</div>

		<div class="form-group">
			<input class="form-control" type="password" name="reg_password2" placeholder="Confirm Password" required>
			<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
			else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
			else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>
		</div>

		<div class="center">
			<input class="btn btn-outline-light btn-lg" type="submit" name="register_button" value="Register">
		</div>
		<!-- Register Successful Message -->
		<?php if(in_array("<span>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span>You're all set! Go ahead and login!</span><br>"; ?>

	</form>

	</div> <!-- End Control -->
</div> <!-- End Container -->

	<span class="copy">
		Carl &copy; 2021
	</span>


<!-- Start Fixed Background -->
	<div class="fixed-wrap">
		<div id="fixed">
		</div>
	</div>
<!-- End Fixed Background -->

<!-- End Form Section -->


</body>
</html>
