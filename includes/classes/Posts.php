<?php
class Post {
    private $user_obj;
    private $con;

    public function __construct($con, $user) {
      $this->con = $con;
      $this->user_obj = new User($con, $user);
    }

    public function submitPost($body, $user_to) {
      $body = strip_tags($body);
      $body = mysqli_real_escape_string($this->con, $body);
      //Remove all the spaces
      $check_empty = preg_replace('/\s+/', '',$body);

      if($check_empty is "") {
        //Current date and time
        $date_added = date("Y-m-d H:i:s");
        //Get username
        $added_by = $this->user_obj->getUsername();



      }
    }

}
?>
