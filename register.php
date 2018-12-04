<?php
  session_start();
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
    //Store variable in session
    $_SESSION['reg_fname'] = $fname;


    //Last Name
    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));
    //Store variable in session
    $_SESSION['reg_lname'] = $lname;


    //Email
    $em = strip_tags($_POST['reg_email']);
    $em = str_replace(' ', '', $em);
    $em = ucfirst(strtolower($em));
    //Store variable in session
    $_SESSION['reg_email'] = $em;


    //Confirmation Email
    $em2 = strip_tags($_POST['reg_email2']);
    $em2 = str_replace(' ', '', $em2);
    $em2 = ucfirst(strtolower($em2));
    //Store variable in session
    $_SESSION['reg_email2'] = $em;


    //Password
    $password = strip_tags($_POST['reg_password']);
    $password2 = strip_tags($_POST['reg_password2']);

    //Date
    $date = date("Y-m-d");

    if($em == $em2) {
      //Check if email is in valid format
      if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
        $em=filter_var($em, FILTER_VALIDATE_EMAIL);

        //Check if email already exists
        $e_check = mysqli_query($con, "Select email from users where email='$em'");
        //Count number of rows returned
        $num_rows = mysqli_num_rows($e_check);

        if($num_rows > 0) {
          echo "Email already in use";
        }

      } else {
        echo "Invalid format";
      }
    } else {
      echo "Emails don't match";
    }

    //Check first name length
    if(strlen($fname) > 25 || strlen($fname) < 2) {
      echo "Your first name must be between 2 and 25 characters";
    }

    //Check last name length
    if(strlen($lname) > 25 || strlen($lname) < 2) {
      echo "Your last name must be between 2 and 25 characters";
    }

    //Check passwords
    if($password != $password2) {
      echo "Your passwords do not match";
    } else {
      if(preg_match('/[^A-Za-z0-9]/', $password)) {
        echo "Your password can only contain letters or numbers";
      }
    }

    if(strlen($password) > 30 || strlen($password) < 5) {
      echo "Your password must be between 5 and 30 characters";
    }






  }
?>


<html>
<head>
  <title>Social Demo</title>
</head>

<body>
  <form action="register.php" method="POST">
      <input type="text" name="reg_fname" placeholder="First Name"
      value="<?php
      if(isset($_SESSION['reg_fname'])){
        echo $_SESSION['reg_fname'];
      }
      ?>"
      required>
      <br />
      <input type="text" name="reg_lname" placeholder="Last Name"
      value="<?php
      if(isset($_SESSION['reg_lname'])){
        echo $_SESSION['reg_lname'];
      }
      ?>"
      required>
      <br />
      <input type="text" name="reg_email" placeholder="Email"
      value="<?php
      if(isset($_SESSION['reg_email'])){
        echo $_SESSION['reg_email'];
      }
      ?>"
       required>
      <br />
      <input type="text" name="reg_email2" placeholder="Confirm Email"
      value="<?php
      if(isset($_SESSION['reg_email2'])){
        echo $_SESSION['reg_email2'];
      }
      ?>"
      required>
      <br />
      <input type="text" name="reg_password" placeholder="Password" required>
      <br />
      <input type="text" name="reg_password2" placeholder="Confirm Password" required>
      <br />
      <input type="submit" name="register_button" value="Register">
  </form>
</body>

</html>
