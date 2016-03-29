<?php
  session_start();
  //If our user isn't logged in, send them to the login page
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }

  //Include the display module for showing images
  include_once('module/module.display.php');
  $disp = new Display;

?>

<html>

<h2>Profile Page - <?= $_SESSION["user"] ?></h2>
<br />
<a href="upload.php"><h4>Upload an Image</h4></a>
<br />
<?php
  //echo var_dump($disp->displayImages());
  foreach($disp->displayImages() as $img):
    //http://stackoverflow.com/questions/20556773/php-display-image-blob-from-mysql
    //echo $img["description"].': <img src="data:image/jpeg;base64,'.base64_encode($img["thumbnail"]).'" width="244" height="244" /> '.$img["owner_name"].'<br />';
    ?>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($img["thumbnail"]); ?>" />
    <?php
  endforeach;
?>
</html>
