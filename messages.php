<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<title>Message | Twitbook</title>
</head>

<body id="message_body">

<!-- Start Message section -->
<div id="home">

	<!-- Navigation -->
	<header>
	<?php $page = 'home';include 'includes/navbar-fixed.php'; ?>
	<?php $page = 'home';include 'includes/navbar-text.php'; ?>
	</header>

<?php
$message_obj = new Message($con, $userLoggedIn);

//Send message to previous user or to a new user
if(isset($_GET['u']))
    $user_to = $_GET['u'];
else {
    $user_to = $message_obj->getMostRecentUser();
    if($user_to == false)
        $user_to = 'new';
}

if($user_to != "new")
    $user_to_obj = new User($con, $user_to);

if(isset($_POST['post_message'])) {

	if(isset($_POST['message_body'])) {
		$body = mysqli_real_escape_string($con, $_POST['message_body']);
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to, $body, $date);
	}
}
?>


    <!-- Start Two Section -->
	<section>
    <div class="container-fluid" id="content">

 	<div class="row">
        <!-- Start Left Section-->
        <div class="col-md-3" id="left-section">

        <div class="content position-fixed" id="left_width">

			<a id="left_alinks" href="<?php echo $userLoggedIn; ?>">
				<div id="left_links_container">
					<div id="icon_wrapper"><img class="rounded-circle w-100"  src="<?php echo $user['profile_pic'] ?>" alt=""></i></div>
					<div id="text_wrapper"><?php echo $user['first_name'] . " " . $user['last_name']; ?></div><br>
				</div>
			</a>

			<a id="left_alinks" href="<?php echo $userLoggedIn; ?>">
				<div id="left_links_container">
					<div id="icon_wrapper"><i class="fas fa-file-alt"></i></div>
					<div id="text_wrapper"><?php echo "Posts: " . $user['num_posts']; ?></div><br>
				</div>
			</a>

			<a id="left_alinks" href="<?php echo $userLoggedIn; ?>">
				<div id="left_links_container">
					<div id="icon_wrapper"><i class="fas fa-thumbs-up"></i></div>
					<div id="text_wrapper"><?php echo "Likes: " . $user['num_likes']; ?></div>
				</div>
			</a><br>

            <hr class="socket">

			<!-- Start Conversation List -->
			<br>
			<div class="" id="conversations">
				<h4>Conversations</h4>

				<div class="loaded_conversations">
					<?php echo $message_obj->getConvos(); ?>
				</div>
				<br>
			</div>
			<!-- End Conversation List -->

			<br><a class="new_message" href="messages.php?u=new">New Message</a>

        </div>

        </div>
        <!-- End Left Section -->


        <!-- Start Middle Section -->
        <div class="col-md-6" id="middle-section">

        <div id="post-container">
        <?php
        if($user_to != "new") {
            echo "<h4>You and <a href='$user_to'>" . $user_to_obj->getFirstAndLastName() . "</a></h4><br>";
			echo "<div class='loaded_messages' id='scroll_messages'>";
				echo $message_obj->getMessages($user_to);
			echo "</div>";
		}
		else {
			echo "<h4>New Message</h4>";
		}
        ?>

		<form class="" action="" method="POST">
			<?php
			if($user_to == "new") {
				echo "Select a friend you would like to send message <br><br>";
				?>

				To: <input type='text' onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='seach_text_input'><br><br>

			<?php
				echo "<div class='results'></div>";
			}
			else {
				echo "<div class='row'>
						<div class='col-11 m-0 p-0 mt-3'>
							<textarea class='form-control' rows='1' id='text_area' name='message_body' id='message_textarea' placeholder='Write your message...'></textarea>
						</div>
						<div class='col-1 p-0 mt-3'>
							<button type='submit' name='post_message' class='btn btn-outline-light btn-sm shadow-sm' value=''>
								<i class='far fa-paper-plane' data-fa-transform='grow-10'></i>
							</button>
						</div>
					</div>";
			}

			?>

		</form>

	    <!-- Autogrow Textarea -->
	    <script>
	        var textarea = document.querySelector('textarea');

	        textarea.addEventListener('keydown', autosize);

	        function autosize(){
	          var el = this;
	          setTimeout(function(){
	            el.style.cssText = 'height:auto; padding:0';
	            // for box-sizing other than "content-box" use:
	            // el.style.cssText = '-moz-box-sizing:content-box';
	            el.style.cssText = 'height:' + el.scrollHeight + 'px';
	          },0);
	        }
	    </script>

		<!-- Go to the bottom of the page on reload -->
		<script>
			var div = document.getElementById("scroll_messages");
			div.scrollTop = div.scrollHeight;
		</script>


		</div> <!-- End Post Container -->

        </div>
        <!-- End Middle Section -->

    </div> <!-- End Row -->


	</div> <!-- End Container-Fluid -->
	</section>
    <!-- End The Three Section -->


</div>
<!-- End Message section -->

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
