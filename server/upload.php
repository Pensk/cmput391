<?php
  session_start();

  include_once("../module/module.upload.php");
  $upload = new Upload;

  $user = $_SESSION["user"];
  if($_POST["permitted"] == "group"){
    $permit = $_POST["group"];
  } elseif($_POST["permitted"] == "true") {
    $permit = 1;
  } else {
    $permit = 2;
  }
  $descr = $_POST["description"];
  $loc = $_POST["location"];
  $time = date('Y-m-d',strtotime($_POST["time"]));
  $subj = $_POST["subject"];

  $c = count($_FILES["image"]["name"]);

  for($x=0;$x<$c;$x++){
    $image = file_get_contents($_FILES["image"]["tmp_name"][$x]);
    $upload->uploadImage($user,$permit,$descr,$loc,$time,$subj,$image);
  }

  header('Location: ../profile.php');
?>
