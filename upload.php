<?php
  session_start();
  //If our user isn't logged in, send them to the login page
  if(!isset($_SESSION["user"])){
    header("Location: login.php");
  }
?>

<html>
<head>
<title>Upload Images</title>
</head>
<body>
<h3>Upload Page</h3>

<h4>Upload .jpg or .gif images to be stored in the database.</h4>
<form enctype="multipart/form-data" action="server/upload.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="64000" />
Upload (Max 64KB): <input name="image" type="file" />
<input type="submit" value="Upload" />
</form>

</body>
</html>
