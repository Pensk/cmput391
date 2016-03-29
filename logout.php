<?php
  //Start the session and destroy the stored data, logging the user out.
  session_start();
  session_destroy();
  //Send the user to login
  header('Location: login.php');
 ?>
