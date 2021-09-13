<?php
//Stop access when not logged in!
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    //$user is to select all data from users table
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
    header("Location: register.php");
}

?>


<div class="navbar-toggle d-none">

<!--- Navigation -->
<nav class="navbar navbar-expand-md fixed-top always-solid animate__animated animate__fadeInDown" id="navbar_text">
<div class="container-fluid">
	<a class="navbar-brand" href="index.php"><img src="assets/images/icons/twitter.ico" alt=""><span id="navbar_brand_text">Twitbook</span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav mx-auto">
			<li class="nav-item text-center">
				<a class="nav-link <?php if($page=='home'){echo 'active';}?>" href="index.php"> Home</a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='home'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link <?php if($page=='messages'){echo 'active';}?>" href="#"> Message</a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='#'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link <?php if($page=='notification'){echo 'active';}?>" href="#"> Alerts</a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='#'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link <?php if($page=='friendrequest'){echo 'active';}?>" href="requests.php"> Requests</a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='friendrequest'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link <?php if($page=='profile'){echo 'active';}?>" href="<?php echo $userLoggedIn; ?>">
                    <img src="<?php echo $user['profile_pic']; ?>" class="rounded-circle" style="max-width: 21px">
					<span><?php echo $user['first_name']; ?></span>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='profile'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link <?php if($page=='settings'){echo 'active';}?>" href="settings.php"> Settings</a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='settings'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link <?php if($page=='logout'){echo 'active';}?>" href="includes/handlers/logout.php"> Logout</a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='#'){echo 'underline-active';}?>"></div>
			</li>
		</ul>
	</div>
</div>
</nav>
</div>

<!--- End Navigation -->
