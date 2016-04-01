<?php
  session_start();
  //If our user isn't logged in, send them to the login page
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }

  //Include the display module for showing images
  include_once('module/module.display.php');
  $disp = new Display;

  $pageTitle = "Profile";
?>

<?php
include_once('template/header.php');
?>
<div class="container">
<h2>Profile Page - <?= $_SESSION["user"] ?></h2>
<br />
<a href="group.php"><h4>Groups</h4></a>
<a href="upload.php"><h4>Upload an Image</h4></a>
<a href="search.php"><h4>Search for Images</h4></a>
<br />
<h3>Most Popular Images</h3>
<div class="row">
  <div class="col-md-1"></div>
<?php
$c = 0;
foreach($disp->mostPopular() as $img):
  if($disp->canView($user,$img["photo_id"])):
?>
<div class="col-md-2 text-center">
<a href="display.php?id=<?= $img["photo_id"] ?>">
<img src="server/image.php?id=<?= $img["photo_id"] ?>" class="center-block" width="100" height="100"/><br />
<h4><strong><?= $img["description"] ?></strong></h4><br /><?= $img["owner_name"] ?>
</a>
</div>
<?php
  $c += 1;
  endif;
  if ($c == 5)
    break;
endforeach;
?>
</div>
</div>
<?php
include_once('template/footer.php');
?>
