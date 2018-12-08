<?php
  require 'config/config.php';

  if (isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users where username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
  } else {
    header("Location: register:php");
  }
?>


<html>
<head>
  <title>Social Demo</title>
  <!-- Javascript  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>

  <div class="top_bar">
      <div class="logo">
          <a href="index.php">Seattle Feed</a>
      </div>

      <nav>
        <a href="#">
          <?php
            echo $user['first_name'];
          ?>
        </a>
        <a href="#"><i class="fa fa-home fa-lg"></i></a>
        <a href="#"><i class="fa fa-envelope fa-lg"></i></a>
        <a href="#"><i class="fa fa-bell fa-lg"></i></a>
        <a href="#"><i class="fa fa-users fa-lg"></i></a>
        <a href="#"><i class="fa fa-cog fa-lg"></i></a>
      </nav>
  </div>
