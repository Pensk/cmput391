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

<body>
<h2>Profile Page - <?= $_SESSION["user"] ?></h2>
<br />
<a href="group.php"><h4>Groups</h4></a>
<a href="upload.php"><h4>Upload an Image</h4></a>
<br />
<?php
  foreach($disp->displayImages() as $img):
    //stackoverflow.com/questions/13214602/how-to-display-an-blob-image-stored-in-mysql-database
    echo $img["description"].': <img src="server/image.php?id='.$img["photo_id"].'" width="244" height="244" /> '.$img["owner_name"].'<br />';

  endforeach;
?>
</body>

<?php
include_once('template/footer.php');
?>
