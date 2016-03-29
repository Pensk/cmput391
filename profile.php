<?php
  session_start();
  //If our user isn't logged in, send them to the login page
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }
  //include_once('module/constants.php');
  include_once('module/module.display.php');
  $disp = new Display;

?>

<html>

<h2>Profile Page - <?= $_SESSION["user"] ?></h2>
<br />
<a href="upload.php"><h4>Upload an Image</h4></a>
<br />
<?php
  foreach($disp->displayImages() as $img):
?>
  <?= $img["photo"] ?>
<?php
  endforeach;
?>
</html>
