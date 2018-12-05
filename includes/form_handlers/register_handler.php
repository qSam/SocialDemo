<?php

//Declare variables to prevent errors
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

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
        array_push($error_array,"Email already in use<br />");
      }

    } else {
        array_push($error_array,"Invalid email format<br />");
    }
  } else {
      array_push($error_array,"Emails don't match<br />");
  }

  //Check first name length
  if(strlen($fname) > 25 || strlen($fname) < 2) {
      array_push($error_array,"Your first name must be between 2 and 25 characters<br />");
  }

  //Check last name length
  if(strlen($lname) > 25 || strlen($lname) < 2) {
    array_push($error_array, "Your last name must be between 2 and 25 characters<br />");
  }

  //Check passwords
  if($password != $password2) {
    array_push($error_array,"Your passwords do not match<br />");
  } else {
    if(preg_match('/[^A-Za-z0-9]/', $password)) {
      array_push($error_array,"Your password can only contain letters or numbers<br />");
    }
  }

  if(strlen($password) > 30 || strlen($password) < 5) {
    array_push($error_array, "Your password must be between 5 and 30 characters<br />");
  }

  //Create username and ecnrypt password
  if(empty($error_array)) {
    //Encrypt password
    $password = md5($password);
    //Generate username by concact firstname and lastname
    $username = strtolower($fname."_"."$lname");
    $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");

    $i = 0;
    //if username exists add number to username
    while(mysqli_num_rows($check_username_query) != 0) {
      $i++;
      $username = $username."_".$i;
      $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");

    }

        //Select profile pic
        $rand =rand(1, 2);
        if($rand == 1) {
          $profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
        } else if ($rand == 2) {
          $profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
        }

        $query = mysqli_query($con, "INSERT INTO users VALUES('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");
        array_push($error_array, "<span style='color: #14C800'>You are all set! Please login.</span><br />");

        //Clear session variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";

  }


}

?>
