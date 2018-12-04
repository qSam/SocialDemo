<?php
  $con = mysqli_connect("localhost","root","","social");

  if(mysqli_connect_errno()) {
    echo "Failed to connect: ".mysqli_connect_errno();
  }

  $query = mysqli_query($con, "INSERT INTO test VALUES('','Rocky')");
?>


<html>
<head>
  <title>Social Demo</title>
</head>

<body>
  Hey there!
</body>

</html>
