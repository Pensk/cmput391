<?php
  session_start();
  if(!isset($_SESSION["user"]))
    header('Location: ../login.php');

  include_once('../module/module.display.php');
  $disp = new Display;

  $user = $_SESSION["user"];
  $imgid = $_GET["id"];

  if($disp->canEdit($user,$imgid)){
    $disp->deleteImage($imgid);
  }

  header('Location: ../profile.php');
?>
