<?php
  include("../../config/config.php");
  include("../classes/User.php");
  include("../classes/Post/php");

  //Number of posts to be loader per posts
  $limit = 10;

  $posts = new Post($con, $_REQUEST['userLoggedIn']);
  $posts->loadPostFriends();


 ?>
