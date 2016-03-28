<?php
  session_start();

  if(isset($_POST["submit"])){
    include_once("module/module.user.php");
    $user = new User;

    $username = $_POST["username"];
    $password = $_POST["password"];

    if($user->login($username,$password)){
      echo "<script>alert('true');</script>";
    } else {
      echo "<script>alert('false');</script>";
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
<form method="POST">
  <input type="text" name="username" placeholder="Username"><br />
  <input type="password" name="password" placeholder="Password"><br />
  <input type="submit" name="submit">
</form>
<a href="register.php"><h3>Register</h3></a>
</body>
</html>
