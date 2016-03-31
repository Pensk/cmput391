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

  $imgid = $_GET["id"];
  $user = $_SESSION["user"];

?>

<?php
include_once('template/header.php');
?>

<body>
  <div class="container">
<h2>Display Image</h2>
<br />
<?php
  if(!$disp->canView($user,$imgid)):
    echo "<h3>You don't have permission to view this image</h3>";
  else:
?>
    <img src="server/image.php?id=<?= $imgid ?>" class="img-resonsive" /><br />
    
<?php
  endif;
?>
</div>
</body>

<?php
include_once('template/footer.php');
?>
