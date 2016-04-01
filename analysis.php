<?php
  session_start();
  //If our user isn't logged in, send them to the login page
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }

  if($_SESSION["user"] != "admin"){
    header("Location: profile.php");
  }

  $user = $_SESSION["user"];

  //Include the display module for showing images
  include_once('module/module.analysis.php');
  $ana = new Analysis;

  $pageTitle = "Profile";

  include_once('template/header.php');
?>
<div class="container">

</div>
<?php
  include_once('template/footer.php');
?>
