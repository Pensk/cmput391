<html>
<head>
<title><?= $pageTitle ?></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <ul class="nav navbar-nav">
        <li><a href="profile.php">Profile</a></li>
        <li><a href="upload.php">Upload</a></li>
        <li><a href="search.php">Search</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(isset($_SESSION["user"])): ?>
        <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
