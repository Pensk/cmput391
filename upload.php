<?php
  session_start();
  //If our user isn't logged in, send them to the login page
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }

  $pageTitle = "Upload";
?>

<?php
include_once('template/header.php');
?>
<body>
<div class="container">
<h3>Upload Page</h3>

<h4>Upload .jpg or .gif images to be stored in the database.</h4>
<form enctype="multipart/form-data" action="server/upload.php" method="POST">
  <div class="form-group"<
<input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="64000" />
Upload (Max 64KB): <input class="form-control" name="image[]" webkitdirectory directory multiple type="file" /><br />
</div>
<div class="form-group">
<input class="form-control" type="radio" name="permitted" value="false" checked />Private
<input class="form-control" type="radio" name="permitted" value="true" />Public
<input class="form-control" type="radio" name="permitted" value="group"/>Or Group ID: <input class="form-control" type="text" name="group" placeholder="group ID" /><br />
</div>
<div class="form-group"<
<input class="form-control" type="text" name="description" placeholder="Description" /><br />
<input class="form-control" type="text" name="location" placeholder="Location" /><br />
<input class="form-control" type="date" name="time" placeholder="Date (Y-M-D)" /><br />
<input class="form-control" type="text" name="subject" placeholder="Subject" /><br />
<input class="form-control" type="submit" value="Upload" />
</div>
</form>
</div>
</body>
<?php
include_once('template/footer.php');
?>
