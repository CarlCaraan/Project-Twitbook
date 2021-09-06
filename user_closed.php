<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<title> 404 | Twitbook </title>
</head>

<body>
<?php $page = 'profile';include 'includes/navbar_sticky.php'; ?>

<div class="container">
    <div class="narrow center"><br>
        <h2>Sorry, this page isn't available</h2><br>
        <h4>The link you followed may be broken, or the page may have been removed.</h4>

        <pre>

            <!-- add extra spacing -->
            <img src="assets/images/no_content.png" alt=""><br>

            <!-- add extra spacing -->
            <a href="index.php">Go back to home page.</a>
        </pre>
    </div>
</div>



<?php include 'includes/scripts.php'; ?>

</body>
</html>
