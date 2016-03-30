<?php
  session_start();

  include_once("../module/module.upload.php");
  $upload = new Upload;

  //prepare the variables to be inserted in the database
  $user = $_SESSION["user"];
  //get the binary data from the image file
  $image = file_get_contents($_FILES["image"]["tmp_name"]);
  $descr = $_FILES["image"]["name"];

  //make sure the user uploaded an image of a valid size!
  if($_FILES["image"]["size"] != 0){
    $upload->uploadImage($user,$descr,$image);
  }
  //redirect them back to their profile page
  var_dump($_FILES);
  //header('Location: ../profile.php');
?>
