<?php
//Stop access when not logged in!
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    //Show username in navbar
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
else {
    header("Location: register.php");
}

?>

<!--- Navigation -->
<nav class="navbar navbar-expand-md fixed-top always-solid">
<div class="container-fluid">
	<a class="navbar-brand" href="index.php"><img src="assets/images/twitter.png" alt=""></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav mx-auto">
			<li class="nav-item text-center mx-auto">
				<a class="nav-link" href="index.php">
					<i class="fas fa-home fa-inverse <?php if($page=='home'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="underline-spacing"></div>
                <div class=" <?php if($page=='home'){echo 'heading-underline';}?>"></div>
			</li>

			<li class="nav-item text-center mx-auto">
				<a class="nav-link" href="#">
					<i class="fas fa-envelope fa-inverse <?php if($page=='messages'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="underline-spacing"></div>
                <div class=" <?php if($page=='#'){echo 'heading-underline';}?>"></div>
			</li>

			<li class="nav-item text-center mx-auto">
				<a class="nav-link" href="#">
					<i class="fas fa-globe-americas fa-inverse <?php if($page=='notification'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="underline-spacing"></div>
                <div class=" <?php if($page=='#'){echo 'heading-underline';}?>"></div>
			</li>

			<li class="nav-item text-center mx-auto">
				<a class="nav-link" href="#">
					<i class="fas fa-users fa-inverse <?php if($page=='friendrequest'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="underline-spacing"></div>
                <div class=" <?php if($page=='#'){echo 'heading-underline';}?>"></div>
			</li>

			<li class="nav-item text-center mx-auto">
				<a class="nav-link <?php if($page=='profile'){echo 'active';}?>" href="<?php echo $userLoggedIn; ?>">
                    <img src="<?php echo $user['profile_pic']; ?>" class="rounded-circle" style="max-width: 21px">
					<?php echo $user['first_name']; ?>
                </a>
                <div class="underline-spacing"></div>
                <div class=" <?php if($page=='profile'){echo 'heading-underline';}?>"></div>
			</li>

			<li class="nav-item text-center mx-auto">
				<a class="nav-link" href="settings.php">
					<i class="fas fa-cog fa-inverse <?php if($page=='settings'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="underline-spacing"></div>
                <div class=" <?php if($page=='settings'){echo 'heading-underline';}?>"></div>
			</li>

			<li class="nav-item text-center mx-auto">
				<a class="nav-link" href="includes/handlers/logout.php">
					<i class="fas fa-sign-out-alt fa-inverse <?php if($page=='logout'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
                <div class="underline-spacing"></div>
                <div class=" <?php if($page=='#'){echo 'heading-underline';}?>"></div>
			</li>
		</ul>
	</div>
</div>
</nav>
<!--- End Navigation -->
