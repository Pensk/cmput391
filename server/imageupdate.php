<?php
  session_start();
  if(!isset($_SESSION["user"]))
    header('Location: ../login.php');
  include_once('../module/module.display.php');
  $disp = new Display;

  $imgid = $_POST["id"];

  if($disp->canEdit($_SESSION["user"],$imgid)) {
    $descr = $_POST["description"];
    $loc = $_POST["place"];
    $time = date('Y-m-d',strtotime($_POST["timing"]));
    $subj = $_POST["subject"];
    $img = $disp->updateImage($imgid,$descr,$loc,$time,$subj);
  }

  header('Location: ../display.php?id='.$imgid);
?>
