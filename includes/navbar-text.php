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

<!-- Start Navigation -->
<nav class="navbar navbar-expand-md fixed-top always-solid animate__animated animate__fadeInDown" id="navbar_text">

	<?php
		//Unread messages
		$messages = new Message($con, $userLoggedIn);
		$num_messages = $messages->getUnreadNumber();
	?>

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
				<a class="nav-link <?php if($page=='messages'){echo 'active';}?>" href="javascript:void(0)" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')"> Message
                    <?php
                    //notification badge
                    if($num_messages > 0)
                        echo '<span class="badge badge-danger" id="unread_message_badge_text">' . $num_messages . '</span>';
                    ?>
                </a>
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

<!-- End Navigation -->

<!-- Start Message Window -->
<div class="dropdown_data_window px-1" style="height: 0px; border: none;"></div>
<input type="hidden" id="dropdown_data_type" name="" value="">
<!-- End Message Window -->

<!-- Ajax Script limit post -->
<script>
var userLoggedIn = '<?php echo $userLoggedIn; ?>';

$(document).ready(function() {

	$('.dropdown_data_window').scroll(function() {
		var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing data
		var scroll_top = $('.dropdown_data_window').scrollTop();
		var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
		var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

		if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

			var pageName; //Holds name of page to send ajax request to
			var type = $('#dropdown_data_type').val();


			if(type == 'notification')
				pageName = "ajax_load_notifications.php";
			else if(type = 'message')
				pageName = "ajax_load_messages.php"


			var ajaxReq = $.ajax({
				url: "includes/handlers/" + pageName,
				type: "POST",
				data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
				cache:false,

				success: function(response) {
					$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage
					$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage


					$('.dropdown_data_window').append(response);
				}
			});

		} //End if

		return false;

	}); //End (window).scroll(function())


});

</script>
