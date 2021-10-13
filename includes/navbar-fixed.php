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

	<?php
		//Unread messages
		$messages = new Message($con, $userLoggedIn);
		$num_messages = $messages->getUnreadNumber();

    	//Unread notifications
    	$notifications = new Notification($con, $userLoggedIn);
    	$num_notifications = $notifications->getUnreadNumber();

    	//Unread friend requests
    	$user_obj = new User($con, $userLoggedIn);
    	$num_requests = $user_obj->getNumberOfFriendRequests();
    ?>

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
                    <?php
                    //notification badge
                    if($num_messages > 0)
                        echo '<span class="badge badge-pill badge-danger" id="unread_message_badge">' . $num_messages . '</span>';
                    ?>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='#'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link" href="javascript:void(0)" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')" id="notification">
					<i id="nav_icon" class="fas fa-globe-americas fa-inverse <?php if($page=='notification'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                    <?php
                    //notification badge
                    if($num_notifications > 0)
                        echo '<span class="badge badge-pill badge-danger" id="unread_message_badge">' . $num_notifications . '</span>';
                    ?>
                </a>
                <div class="spacing"></div>
                <div class=" <?php if($page=='#'){echo 'underline-active';}?>"></div>
			</li>

			<li class="nav-item text-center">
				<a class="nav-link" href="requests.php" id="friendrequest">
					<i id="nav_icon" class="fas fa-users fa-inverse <?php if($page=='friendrequest'){echo 'active';}?>" data-fa-transform="grow-10"></i>
                    <?php
                    //notification badge
                    if($num_requests > 0)
                        echo '<span class="badge badge-pill badge-danger" id="unread_message_badge">' . $num_requests . '</span>';
                    ?>
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

<!-- Start Live Search -->
<div class="search">
    <form class="form-inline" action="search.php" method="GET" name="search_form">
        <div class="input-group">
            <input id="search_input" type="text" class="form-control" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off">
            <div class="input-group-append">
                <button class="btn_search input-group-text"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>

    <div class="search_results">

    </div>
    
    <div class="search_results_footer_empty">

    </div>
</div>
<!-- End Live Search -->

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
