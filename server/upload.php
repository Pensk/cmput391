<?php
  session_start();

  include_once("../module/module.upload.php");
  $upload = new Upload;

  $user = $_SESSION["user"];
  $image = file_get_contents($_FILE["image"]["tmp_name"]);

  $upload->uploadImage($user,$image);
?>
