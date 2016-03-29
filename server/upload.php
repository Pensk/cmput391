<?php
  session_start();

  include_once("../module/module.upload.php");
  $upload = new Upload;

  $user = $_SESSION["user"];
  $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $descr = $_FILES["image"]["name"];

  $upload->uploadImage($user,$descr,$image);

  header('Location: ../profile.php');
?>
