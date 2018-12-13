<?php
  include("../../config/config.php");
  include("../classes/User.php");
  include("../classes/Posts.php");

  //Number of posts to be loader per posts
  $limit = 10;

  $posts = new Post($con, $_REQUEST['userLoggedIn']);
  $posts->loadPostsFriends($_REQUEST, $limit);


 ?>
