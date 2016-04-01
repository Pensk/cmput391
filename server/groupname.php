<?php
  session_start();
  if(!isset($_SESSION["user"]))
    header('Location: ../login.php');

  include_once('../module/module.group.php');
  $group = new Group;

  $user = $_SESSION["user"];
  $groupid = $_POST["groupid"];
  $groupname = $_POST["groupname"];

  if($group->isOwner($user,$groupid)){
    $group->setName($groupid,$groupname);
  }

  header('Location: ../groupedit.php?id='.$groupid);
?>
