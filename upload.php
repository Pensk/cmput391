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
Upload (Max 64KB): <input name="image" webkitdirectory directory multiple type="file" /><br />
<input type="radio" name="security" value="private" checked />Private
<input type="radio" name="security" value="public" />Public<br />
<input type="text" name="description" placeholder="Description" /><br />
<input type="text" name="location" placeholder="Location" /><br />
<input type="text" name="time" placeholder="Time" /><br />
<input type="text" name="subject" placeholder="Subject" /><br />
<input type="submit" value="Upload" />
</form>

</body>
</html>
