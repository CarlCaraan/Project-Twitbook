<?php
include ("../../config/config.php")
include ("../classes/User.php")

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$name = explode(" ", $query);

?>