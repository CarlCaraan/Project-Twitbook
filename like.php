<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
    <title></title>
</head>

<body class="iframe_body center" id="iframe_body_like">
    <?php
    require("config/config.php");
    include("includes/classes/User.php");
    include("includes/classes/Post.php");
	include("includes/classes/Notification.php");

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


        //Get id of post
        if(isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
        }

        //Get Likes
        $get_likes = mysqli_query($con, "SELECT likes, added_by FROM posts WHERE id='$post_id'");
        $row = mysqli_fetch_array($get_likes);
        $total_likes = $row['likes'];
        $user_liked = $row['added_by'];

        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user_liked'");
        $row = mysqli_fetch_array($user_details_query);
		$total_user_likes = $row['num_likes'];

        //Like button
		if(isset($_POST['like_button'])) {
			$total_likes++;
			$query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
			$total_user_likes++;
			$user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");

			$insert_user = mysqli_query($con, "INSERT INTO likes VALUES ('', '$userLoggedIn', '$post_id')");

			//Insert Notification
			if($user_liked != $userLoggedIn) {
                $notification = new Notification($con, $userLoggedIn);
                $notification->insertNotification($post_id, $user_liked, "like");
			}
		}
        //Unlike button
		if(isset($_POST['unlike_button'])) {
			$total_likes--;
			$query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
			$total_user_likes--;
			$user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");

			$insert_user = mysqli_query($con, "DELETE FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
		}


        //Check for previous likes
        $check_query = mysqli_query($con, "SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
        $num_rows = mysqli_fetch_array($check_query);

        if($num_rows > 0) {
			if($total_likes < 2) {
            echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
                    <button type="submit" class="comment_like" name="unlike_button" value="">
						<i class="far fa-thumbs-down" data-fa-transform="grow-1"></i> Unlike
						<span id="total_likes">(' . $total_likes . ' Like)</span>
                    </button>
                </form>
            ';
			}
			else {
			//grammar of 1likes
            echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
                    <button type="submit" class="comment_like" name="unlike_button" value="">
                        <i class="far fa-thumbs-down" data-fa-transform="grow-1"></i> Unlike
						<span id="total_likes">(' . $total_likes . ' Likes)</span>
                    </button>
                </form>
            ';
			}
        } //-- End If --//
        else {
			//grammar of 1likes
			if($total_likes < 2) {
            echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
                    <button type="submit" class="comment_like" name="like_button" value="">
                        <i class="far fa-thumbs-up" data-fa-transform="grow-1"></i> Like
						<span id="total_likes">(' . $total_likes . ' Like)</span>
                    </button>
                </form>

            ';
			}
			else {
            echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
                    <button type="submit" class="comment_like" name="like_button" value="">
                        <i class="far fa-thumbs-up" data-fa-transform="grow-1"></i> Likes
						<span id="total_likes">(' . $total_likes . ' Likes)</span>
                    </button>
                </form>

            ';
			}
        } //-- End Else --//

    ?>


<?php include 'includes/scripts.php'; ?>

</body>
</html>
