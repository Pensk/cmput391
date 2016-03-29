<?php
  session_start();

  include_once("../module/module.upload.php");
  $upload = new Upload;

  $user = $_SESSION["user"];
  $image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

  $upload->uploadImage($user,$image);

  header('Location: ../profile.php');
?>
