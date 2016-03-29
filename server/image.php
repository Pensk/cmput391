<?php
  include_once('../module/module.display.php');
  $disp = new Display;

  $imgid = $_GET["id"];

  $img = Display->getImageFromId($imgid);

  header('Content-type: image/jpeg');

  echo $image;
?>
