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

<!-- Dark Mode Switch -->
<div class="theme-switch-wrapper">
    <span id="toggle-icon">
        <span class="toggle-text">Light Mode</span>
        <i class="fas fa-sun" data-fa-transform="grow-5"></i>
    </span>

    <!-- Default bootstrap switch -->
    <div class="theme-switch custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" id="customSwitches">
      <label class="custom-control-label" for="customSwitches"></label>
    </div>
</div>

<!-- Start Navigation -->
<nav class="navbar navbar-expand-md always-solid">
<div class="container-fluid">
	<a class="navbar-brand" href="index.php"><img src="assets/images/icons/twitter.ico" alt=""><span id="navbar_brand_text">Twitbook</span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav mx-auto">
			<li class="nav-item text-center">
				<a class="nav-link" href="index.php" id="home">
					<i id="nav_icon" class="fas fa-home fa-inverse <?php if($page=='home'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='home'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link" href="javascript:void(0)" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')" id="messages">
					<i id="nav_icon" class="fas fa-envelope fa-inverse <?php if($page=='messages'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='#'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link" href="#" id="notification">
					<i id="nav_icon" class="fas fa-globe-americas fa-inverse <?php if($page=='notification'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='#'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link" href="requests.php" id="friendrequest">
					<i id="nav_icon" class="fas fa-users fa-inverse <?php if($page=='friendrequest'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='friendrequest'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link <?php if($page=='profile'){echo 'active';}?>" href="<?php echo $userLoggedIn; ?>" id="profile">
                    <img src="<?php echo $user['profile_pic']; ?>" class="rounded-circle" style="max-width: 21px">
					<span><?php echo $user['first_name']; ?></span>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='profile'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link" href="settings.php" id="settings">
					<i id="nav_icon" class="fas fa-cog fa-inverse <?php if($page=='settings'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='settings'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link" href="includes/handlers/logout.php" id="logout">
					<i id="nav_icon" class="fas fa-sign-out-alt fa-inverse <?php if($page=='logout'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='#'){echo 'underline-active';}?>"></div>
			</li>
		</ul>
	</div>
</div>
</nav>
<!-- End Navigation -->

<!-- Start Message Window -->
<div class="dropdown_data_window"></div>
<input type="hidden" id="dropdown_data_type" name="" value="">
<!-- End Message Window -->
