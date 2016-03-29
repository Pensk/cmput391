<?php
  session_start();

  if(isset($_POST["submit"])){
    include_once("module/module.user.php");
    $user = new User;

    $username = $_POST["username"];
    $password = $_POST["password"];

    if($user->login($username,$password)){
      $_SESSION["user"] = $username;
      header("Location: profile.php");
    } else {
      echo "<script>alert('Incorrect Login');</script>";
    }
  }
?>

<html>
<head>
  <title>Login</title>
</head>
<body>
<h2>Login page</h2>
<br />
<?php if(isset($_SESSION["user"])): ?>
<h4>You're already logged in.</h4>
<a href="logout.php"><h4>Log Out</h4></a>
<?php else: ?>
<form method="POST">
  <input type="text" name="username" placeholder="Username"><br />
  <input type="password" name="password" placeholder="Password"><br />
  <input type="submit" name="submit">
</form>
<a href="register.php"><h3>Register</h3></a>
<?php endif; ?>
</body>
</html>
