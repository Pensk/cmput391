<?php
  session_start();
  if(!isset($_SESSION["user"]))
    header('Location: ../login.php');

  include_once('../module/module.group.php');
  $group = new Group;

  $user = $_SESSION["user"];
  $groupid = $_GET["id"];

  if($group->isOwner($user,$groupid)){
    $group->deleteGroup($groupid);
  }

  header('Location: ../group.php');
?>
