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

  if(isset($_GET["id"])) {
    $imgid = $_GET["id"];
  }
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
    <table class="table">
      <tr class="text-center">
      <th>Owner</th>
      <th>Description</th>
      <th>Subject</th>
      <th>Place</th>
      <th>Date</th>
      </tr>
      <tr>
        <td><?= $imginfo["owner_name"] ?></td>
        <td><?= $imginfo["description"] ?></td>
        <td><?= $imginfo["subject"] ?></td>
        <td><?= $imginfo["place"] ?></td>
        <td><?= $imginfo["timing"] ?></td>
      </tr>
    </table>
  <?php
    if($disp->canEdit($user,$imgid)):
  ?>
    <form class="form" action="server/imageupdate.php" method="POST">
      <div class="form-group">
        <input type="hidden" name="id" value="<?= $imginfo["photo_id"] ?>" />
        Group ID:<input class="form-control" type="text" name="group" value="<?= $imginfo["permitted"] ?>" />
        Description:<input class="form-control" type="text" name="description" value="<?= $imginfo["description"] ?>" />
        Subject:<input class="form-control" type="text" name="subject" value="<?= $imginfo["subject"] ?>" />
        Location:<input class="form-control" type="text" name="place" value="<?= $imginfo["place"] ?>" />
        Date:<input class="form-control" type="date" name="timing" value="<?= $imginfo["timing"] ?>" />
        <input class="form-control" type="submit" name="submit" value="Update Image" />
      </div>
    </form>
<?php
    endif;
    //add a view count for this image
    $disp->userViewed($user,$imgid);

  endif;
?>
</div>

<?php
include_once('template/footer.php');
?>
