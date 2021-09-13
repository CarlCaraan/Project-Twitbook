<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");

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

$message_obj = new Message($con, $userLoggedIn);

//Send message to previous user or to a new user
if(isset($_GET['u']))
    $user_to = $_GET['u'];
else {
    $user_to = $message_obj->getMostRecentUser();
    if($user_to = false)
        $user_to = 'new';
}


?>
