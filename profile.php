<?php
  session_start();
  //If our user isn't logged in, send them to the login page
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }
?>

<html>

<h2>Profile Page - <?= $_SESSION["user"] ?></h2>

</html>
