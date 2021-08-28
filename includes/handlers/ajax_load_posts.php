<?php
include('../../assets/config.php');
include('../classes/User.php');
include('../classes/Post.php');

$limit = 10; //Number of post to be loaded per call

$post = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadPostsFriends();
?>
