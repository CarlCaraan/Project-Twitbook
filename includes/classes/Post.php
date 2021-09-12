<?php
class Post {
    private $user_obj;
    private $con;

	public function __construct($con, $user){
		$this->con = $con;
        $this->user_obj = new User($con, $user);
	}

	public function submitPost($body, $user_to) {
        $body = strip_tags($body); //remove html tags
		$body = mysqli_real_escape_string($this->con, $body);
        $check_empty = preg_replace('/\s+/', '', $body); //delete all spaces

        if($check_empty != "") {


            //Current Date
            $date_added = date("Y-m-d H:i:s");
            //Get username
            $added_by = $this->user_obj->getUsername();

            //If user is on own profile, user_to is 'none'
            if($user_to == $added_by) {
                $user_to = "none";
            }

            //Insert post
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES ('', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no','0')");
            $retured_id = mysqli_insert_id($this->con);

            //Insert notification

            //Update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");

        }
	} /*-- End submitPost() --*/

	public function loadPostsFriends($data, $limit) {

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUsername();

		if($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;


        $str = ""; //String to return
        $data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

		if(mysqli_num_rows($data_query) > 0) {


			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;


            while($row = mysqli_fetch_array($data_query)) {
                $id = $row['id'];
                $body = $row['body'];
                $added_by = $row['added_by'];
                $date_time = $row['date_added'];

                //prepare user_to string so it can be included even if not posted to a user
				if($row['user_to'] == "none") {
					$user_to = "";
				}
				else {
					$user_to_obj = new User($this->con, $row['user_to']);
					$user_to_name = $user_to_obj->getFirstAndLastName();
					$user_to = " to <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
				}

                //Check if user who posted, has their account closed
                $added_by_obj = new User($this->con, $added_by);
                if($added_by_obj-> isClosed()) {
                    continue;
                }

                //-- Display only friend posts --//
                $user_logged_obj = new User($this->con, $userLoggedIn);
                if($user_logged_obj->isFriend($added_by)) {



    				if($num_iterations++ < $start)
    					continue;


    				//Once 10 posts have been loaded, break
    				if($count > $limit) {
    					break;
    				}
    				else {
    					$count++;
    				}

                    //Delete Button
                    if($userLoggedIn == $added_by)
                        $delete_button = "<button class='btn float-right rounded-circle' id='post$id'>
                                                <i class='far fa-trash-alt' data-fa-transform='shrink-3'></i>
                                            </button>";
                     else
                        $delete_button = "";

                    $user_details_query = mysqli_query($this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
                    $user_row = mysqli_fetch_array($user_details_query);
                    $first_name = $user_row['first_name'];
                    $last_name = $user_row['last_name'];
                    $profile_pic = $user_row['profile_pic'];

                    ?>

                    <!-- Toggle Comment -->
                    <script>
                        function toggle<?php echo $id;?>() {

                            //var target = $(event.target);
                            //if(!target.is("")) {

                                var element = document.getElementById("toggleComment<?php echo $id; ?>");

                                if(element.style.display == "block")
                                    element.style.display = "none";
                                else
                                    element.style.display = "block";
                            //}
                        }
                    </script>


                    <?php
                    //Count the number of comment
                    $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
                    $comments_check_num = mysqli_num_rows($comments_check);


                    //Timeframe
                    $date_time_now = date("Y-m-d H:i:s");
                    $start_date = new DateTime($date_time); //Time of post
                    $end_date = new DateTime($date_time_now); //Current Time
                    $interval = $start_date->diff($end_date); //Difference between dates
                    if($interval->y >= 1) {
                        if($interval == 1)
                            $time_message = $interval->y . " year ago"; //prints "1 year ago"
                        else
                            $time_message = $interval->y . " years ago"; //prints "1+ year ago"
                    }
                    else if ($interval->m >= 1) {
                        if($interval->d == 0){
                            $days = " ago";
                        }
                        else if($interval->d == 1){
                            $days = $interval->d . " day ago";
                        }
                        else {
                            $days = $interval->d . " days ago";
                        }


                        if($interval->m == 1) {
                            $time_message = $interval->m . " month" . $days;
                        }
                        else {
                            $time_message = $interval->m . " months" . $days;
                        }

                    }
                    else if($interval->d >= 1) {
                        if($interval->d == 1) {
                            $time_message = "Yesterday";
                        }
                        else {
                            $time_message = $interval->d . " days ago";
                        }
                    }
                    else if ($interval->h >= 1) {
                        if($interval->h == 1) {
                            $time_message = $interval->h . " hour ago";
                        }
                        else {
                            $time_message = $interval->h . " hours ago";
                        }
                    }
                    else if ($interval->i >= 1) {
                        if($interval->i == 1) {
                            $time_message = $interval->i . " minute ago";
                        }
                        else {
                            $time_message = $interval->i . " minutes ago";
                        }
                    }
                    else {
                        if($interval->s < 30) {
                            $time_message = "Just now";
                        }
                        else {
                            $time_message = $interval->s . " seconds ago";
                        }
                    }
                    //Same as $str = $str . " "
                    $str .= "<div class='card'>
                                <div class='card-body'>
                                    <a href='$added_by' id='profilepic_atag'>
                                        <img class='rounded-circle shadow-sm' src='$profile_pic'>
                                    </a>
                                    <a href='$added_by'> $first_name $last_name</a>$user_to &nbsp;&nbsp;&nbsp;&nbsp;<span>$time_message</span>
                                    $delete_button
                                    <p>$body</p>
                                </div>

                                <img class='card-img' src='assets/images/test1.jpg' alt=''>
                                <hr class='socket'>

                                <!-- like & comment button -->
                                <div class='row center'>
                                    <div class='col'>
                                        <iframe id='comment_iframe' src='like.php?post_id=$id'></iframe>
                                    </div>
                                    <div class='col' onClick='javascript:toggle$id()' id='comment_button'>
                                        <a><i class='far fa-comment-alt'></i> Comment($comments_check_num)</a>
                                    </div>
                                </div>

                                <!-- load comment(iframe) -->
                                <div class='post_comment' id='toggleComment$id'>
                                    <hr class='socket'>
                                    <iframe src='comment_frame.php?post_id=$id' height='450'></iframe>
                                </div>
                            </div> <!-- End card -->

                            ";
                } //-- End Display only friend posts --//

                ?>

                <!-- Delete bootbox.js -->
                <script>

                    $(document).ready(function() {
                        $('#post<?php echo $id; ?>').on('click', function() {
                            bootbox.confirm("Are you sure you want to delete this post?", function(result){

                                $.post("includes/handlers/delete_post.php?post_id=<?php echo $id; ?>", {result, result});

                                if(result)
                                    location.reload();

                            });
                        });
                    });

                </script>
                <?php
            } //-- End While loop --//

			if($count > $limit)
				$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
							<input type='hidden' class='noMorePosts' value='false'>";
			else
				$str .= "<input type='hidden' class='noMorePosts' value='true'><p class='center'> No more posts to show! </p>";

        } //-- End If my_sqli_num_rows --//

        echo $str;


    } //-- End loadPostsFriends() --//






}





?>
