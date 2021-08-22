<?php
require 'config/config.php';

//Stop access when not logged in!
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
}
else {
    header("Location: register.php");
}

?>

<!--- Navigation -->
<nav class="navbar navbar-expand-md fixed-top">
<div class="container-fluid">
	<a class="navbar-brand" href="index.php"><img src="assets/images/twitter.png" alt=""></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav mx-auto">
			<li class="nav-item">
				<a class="nav-link" href="index.php">
					<i class="fas fa-home fa-inverse <?php if($page=='home'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<i class="fas fa-envelope fa-inverse <?php if($page=='messages'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<i class="fas fa-globe-americas fa-inverse <?php if($page=='notification'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<i class="fas fa-users fa-inverse <?php if($page=='friendrequest'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="settings.php">
					<i class="fas fa-cog fa-inverse <?php if($page=='settings'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<i class="fas fa-sign-out-alt fa-inverse <?php if($page=='logout'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                </a>
			</li>
		</ul>
	</div>
</div>
</nav>
<!--- End Navigation -->
