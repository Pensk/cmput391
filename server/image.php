<?php
  include_once('../module/module.display.php');
  $disp = new Display;

  $imgid = $_GET["id"];

  $img = $disp->getImageFromId($imgid);

  header('Content-type: image/png');

  echo $image;
?>
