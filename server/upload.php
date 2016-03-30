<?php
  session_start();

  include_once("../module/module.upload.php");
  $upload = new Upload;

  $user = $_SESSION["user"];
  if($_POST["permitted"] == "true"){
    $permit = 1;
  } else {
    $permit = 0;
  }
  $descr = $_POST["description"];
  $loc = $_POST["location"];
  $time = date('Y-m-d',strtotime($_POST["time"]));
  $subj = $_POST["subject"];

  $c = count($_FILES["image"]["name"]);

  for($x=0;x<$c;x++){
    $image = file_get_contents($_FILES["image"]["tmp_name"][$x]);
    $upload->uploadImage($user,$permit,$descr,$loc,$time,$subj,$image);
  }

  /*
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

  //header('Location: ../profile.php');
  */
?>
