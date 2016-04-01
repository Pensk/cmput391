<?php
  session_start();
  if(!isset($_SESSION["user"]))
    header('Location: ../login.php');
  include_once('../module/module.display.php');
  $disp = new Display;

  $imgid = $_GET["id"];

  if($disp->canView($_SESSION["user"],$imgid))
    $img = $disp->getImageFromId($imgid);

  header('Content-type: image/jpeg');

  echo $img;
?>
