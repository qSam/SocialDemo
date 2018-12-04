<?php
  $con = mysqli_connect("localhost","root","","social");

  if(mysqli_connect_errno()) {
    echo "Failed to connect: ".mysqli_connect_errno();
  }

  //Declare variables to prevent errors
  $fname = "";
  $lname = "";
  $em = "";
  $em2 = "";
  $password = "";
  $password2 = "";
  $date = "";
  $error_array = "";

  if(isset($_POST['register_button'])) {
    // Regsiter form VALUES

    //First Name
    //Remove html tags
    $fname = strip_tags($_POST['reg_fname']);
    //Remove spaces
    $fname = str_replace(' ', '', $fname);
    //Uppercase first char
    $fname = ucfirst(strtolower($fname));


    //Last Name
    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));


    //Email
    $em = strip_tags($_POST['reg_email']);
    $em = str_replace(' ', '', $em);
    $em = ucfirst(strtolower($em));


    //Confirmation Email
    $em2 = strip_tags($_POST['reg_email2']);
    $em2 = str_replace(' ', '', $em2);
    $em2 = ucfirst(strtolower($em2));


    //Password
    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);

    $date = date("Y-m-d");


  }
?>


<html>
<head>
  <title>Social Demo</title>
</head>

<body>
  <form action="register.php" method="POST">
      <input type="text" name="reg_fname" placeholder="First Name" required>
      <br />
      <input type="text" name="reg_lname" placeholder="Last Name" required>
      <br />
      <input type="text" name="reg_email" placeholder="Email" required>
      <br />
      <input type="text" name="reg_email2" placeholder="Confirm Email" required>
      <br />
      <input type="text" name="reg_password" placeholder="Password" required>
      <br />
      <input type="text" name="reg_password2" placeholder="Confirm Password" required>
      <br />
      <input type="submit" name="register_button" value="Register">
  </form>
</body>

</html>
