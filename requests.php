<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
    <title>Requests | Twitbook</title>
</head>
<body id="request_body">

<!-- Start Request Section -->
<div id="friendrequest" class="offset">

	<!-- Navigation -->
    <?php $page = 'friendrequest';include 'includes/navbar_sticky.php'; ?>


<!-- Start Section Content -->
<div class="container">
    <div class="narrow center"><br>
        <div id="post-container">
            <h2>Friend Request</h2>

            <?php

            $query = mysqli_query($con, "SELECT * FROM friend_requests WHERE user_to='$userLoggedIn'");
            if(mysqli_num_rows($query) == 0)
                echo "You Have no friend request at this time!";
            else {

                while($row = mysqli_fetch_array($query)) {
                    $user_from = $row['user_from'];
                    $user_from_obj = new User($con, $user_from);
                    ?>

                    <br><hr class="socket">
                    
                    <?php
                    echo $user_from_obj->getFirstAndLastName() . " sent you a friend request!";

                    $user_from_friend_array = $user_from_obj->getFriendArray();

                    if(isset($_POST['confirm_request' . $user_from])) {
                        $add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$user_from,') WHERE username='$userLoggedIn'");
                        $add_friend_query = mysqli_query($con, "UPDATE users SET friend_array=CONCAT(friend_array, '$userLoggedIn,') WHERE username='$user_from'");

                        $delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
                        echo "Friend request confirmed!";
                        header("Location: requests.php");
                    }

                    if(isset($_POST['delete_request' . $user_from])) {
                        $delete_query = mysqli_query($con, "DELETE FROM friend_requests WHERE user_to='$userLoggedIn' AND user_from='$user_from'");
                        echo "Friend request deleted";
                        header("Location: requests.php");
                    }

                    ?>
                        <form action="requests.php" method="POST">
                            <input class="btn btn-outline-light btn-sm shadow-sm w-25" type="submit" name="confirm_request<?php echo $user_from; ?>" value="Confirm">
                            <input class="btn btn-outline-light btn-sm shadow-sm w-25" type="submit" name="delete_request<?php echo $user_from; ?>" value="Delete">
                        </form>
                    <?php
                }
            }


            ?>

        </div> <!-- End post-container -->
    </div> <!-- End narrow -->
</div>
<!-- End Section Content -->

</div>
<!-- End Request Section -->


<!-- Top Scroll -->
<a href="#friendrequest" class="top-scroll">
	<i class="fas fa-angle-up"></i>
</a>
<!-- End of Top Scroll -->

<?php include 'includes/scripts.php'; ?>

</body>
</html>
