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
      <?php
      if (in_array("Your first name must be between 2 and 25 characters<br />",$error_array)) {
        echo "Your first name must be between 2 and 25 characters<br />";
      }
       ?>
      <input type="text" name="reg_lname" placeholder="Last Name"
      value="<?php
      if(isset($_SESSION['reg_lname'])){
        echo $_SESSION['reg_lname'];
      }
      ?>"
      required>
      <br />
      <?php
      if (in_array("Your last name must be between 2 and 25 characters<br />",$error_array)) {
        echo "Your last name must be between 2 and 25 characters<br />";
      }
       ?>
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
      <?php if (in_array("Email already in use<br />",$error_array)) {echo "Email already in use<br />";}
      else if (in_array("Invalid email format<br />",$error_array)) {echo "Invalid email format<br />";}
      else if (in_array("Emails don't match<br />",$error_array)) {echo "Emails don't match<br />";}?>
      <input type="text" name="reg_password" placeholder="Password" required>
      <br />
      <input type="text" name="reg_password2" placeholder="Confirm Password" required>
      <br />
      <?php if (in_array("Your passwords do not match<br />",$error_array)) {echo "Your passwords do not match<br />";}
      else if (in_array("Your password can only contain letters or numbers<br />",$error_array)) {echo "Your password can only contain letters or numbers<br />";}
      else if (in_array("Your password must be between 5 and 30 characters<br />",$error_array)) {echo "Your password must be between 5 and 30 characters<br />";}?>
      <input type="submit" name="register_button" value="Register">
  </form>
</body>

</html>
