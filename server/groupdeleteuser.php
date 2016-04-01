<?php
  session_start();
  if(!isset($_SESSION["user"]))
    header('Location: ../login.php');

  include_once('../module/module.group.php');
  $group = new Group;

  $user = $_SESSION["user"];
  $groupid = $_GET["groupid"];
  $userid = $_GET["id"];

  if($group->isOwner($user,$groupid)){
    $group->deleteUser($groupid,$userid);
  }

  header('Location: ../groupedit.php?id='.$groupid);
?>
