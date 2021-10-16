<?php
require("config/config.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");


if(isset($_GET['q'])) {
    $query = $_GET['q'];
}
else {
    $query = "";
}

if(isset($_GET['type'])) {
    $type = $_GET['type'];
}
else {
    $type = "name";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<title>Twitbook</title>
</head>
<body>


<!-- Start Search section -->
<div id="search">

	<!-- Navigation -->
	<header>
	<?php $page = 'profile';include 'includes/navbar.php'; ?>
	</header>


<div class="container">
    <div class="narrow center"><br><br><br><br>
        <div id="post-container">

        <?php
        if($query == "")
            echo "You must enter something in the search box.";

        else {
            //If query contains an underscore, assume user is searching for usernames
            if($type == "username")
            	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
            //If there are two words, assume they are first and last names respectively
            else {

                $names = explode(" ", $query);

                if(count($names) == 3)
                	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[2]%') AND user_closed='no");
                //If query has one word only, search first names or last names
                else if(count($names) == 2)
                	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[1]%') AND user_closed='no'");
                else
                	$usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no'");

            }

            //Check if results were found
            if(mysqli_num_rows($usersReturnedQuery) == 0)
                echo "We can't find anyone with a " . $type . " like: " . $query;
            else
                echo mysqli_num_rows($usersReturnedQuery) . " results found: <br> <br>";


            echo "<p class='text-secondary'> Try searching for:</p>";
            echo "<a href='search.php?q=" . $query . "&type=name'>Names</a> , <a href='search.php?q=" . $query . "&type=username'>Usernames</a><br><br><hr class='socket'>";

            while($row = mysqli_fetch_array($usersReturnedQuery)) {
                $user_obj = new User($con, $user['username']);

                $button = "";
                $mutual_friends = "";

                if($user['username'] != $row['username']) {

                    //Generate button depending on friendship status
                    if($user_obj->isFriend($row['username']))
                        $button = "<input type='submit' name='" . $row['username'] . "' class='btn btn-outline-light btn-sm shadow-sm' id='search_button' value='Remove Friend'>";
                    else if($user_obj->didReceiveRequest($row['username']))
                        $button = "<input type='submit' name='" . $row['username'] . "' class='btn btn-outline-light btn-sm shadow-sm' id='search_button' value='Respond to request'>";
                    else if($user->obj->didSendRequest($row['username']))
                        $button = "<input class='btn btn-outline-light btn-sm shadow-sm' id='search_button' value='Request Sent'>";
                    else
                        $button = "<input type='submit' name='" . $row['username'] . "' class='btn btn-outline-light btn-sm shadow-sm' id='search_button' value='Add Friend'>";

				    $mutual_friends = $user_obj->getMutualFriends($row['username']) . " friends in common";

                    //Button forms
    				if(isset($_POST[$row['username']])) {

    					if($user_obj->isFriend($row['username'])) {
    						$user_obj->removeFriend($row['username']);
    						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    					}
    					else if($user_obj->didReceiveRequest($row['username'])) {
    						header("Location: requests.php");
    					}
    					else if($user_obj->didSendRequest($row['username'])) {

    					}
    					else {
    						$user_obj->sendRequest($row['username']);
    						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    					}

    				}


                }

    			echo "<div class='resultDisplay'>

                        <div class='row'>

        					<div class='liveSearchProfilePic col-3 pt-0'>
        						<a href='" . $row['username'] ."'><img src='". $row['profile_pic'] ."' class='rounded-circle float-right' id='search_profilepic'></a>
        					</div>

                            <div class='liveSearchText col-3 pt-0 pl-0 ml-0 float-left' id='search_username'>
        						<a href='" . $row['username'] ."'> " . $row['first_name'] . " " . $row['last_name'] . "
        					    	<br> " . $row['username'] ." <br>
        						</a>
        						" . $mutual_friends ."<br>
                            </div>
    		                <div class='searchPageFriendButtons col-6' id='search_username'>
        						<form action='' method='POST'>
        							" . $button . "
        							<br>
        						</form>
        					</div>

                        </div>
    				</div>";

            } //End While loop
        }
        ?>

        </div> <!-- End post-container -->
    </div> <!-- End narrow -->
</div>
<!-- End Section Content -->

</div>


</div>
<!-- End Search section -->

<!-- Top Scroll -->
<a href="#home" class="top-scroll">
	<i class="fas fa-angle-up"></i>
</a>
<!-- End of Top Scroll -->

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
