<?php
  session_start();
  //If our user isn't logged in, send them to the login page
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }

  //Include the display module for showing images
  include_once('module/module.display.php');
  $disp = new Display;
  $pageTitle = "Display Page";

  if(isset($_GET["id"]))
    $imgid = $_GET["id"];
  $user = $_SESSION["user"];

?>

<?php
include_once('template/header.php');
?>

<div class="container">
<h2>Display Image</h2>
<br />
<?php
  if(!isset($_GET["id"])):
    echo "<h3>Error - No Image ID Provided</h3>";
  elseif(!$disp->canView($user,$imgid)):
    echo "<h3>You don't have permission to view this image</h3>";
  else:
    $imginfo = $disp->getImageInfo($imgid);
?>
    <img src="server/image.php?id=<?= $imgid ?>" class="img-responsive center-block" /><br />
    <h4>Owner:</h4><p><?= $imginfo["owner_name"] ?></p><br />
    <h4>Description:</h4><p><?= $imginfo["description"] ?></p><br />
    <h4>Subject:</h4><p><?= $imginfo["subject"] ?></p><br />
    <h4>Place:</h4><p><?= $imginfo["place"] ?></p><br />
    <h4>Date:</h4><p><?= $imginfo["timing"] ?></p><br />

<?php
  endif;
?>
</div>

<?php
include_once('template/footer.php');
?>
