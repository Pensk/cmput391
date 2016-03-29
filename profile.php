<?php
  session_start();
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }
?>

<html>

<h2>Profile Page -<?= $_SESSION["user"] ?></h2>

</html>
