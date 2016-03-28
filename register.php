<?php
  session_start();

  if(isset($_POST['submit']))
  {
    include_once('../module/user.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    echo "<script>alert(".$user->register($username,$password,$firstname,$lastname,$address,$email,$phone).")</script>";
  }
?>

<html>
<head>
  <title>Register</title>
</head>
<body>
<h2>Register page</h2>
<br />
<form method="POST">
  <input type="text" name="username" placeholder="Username"><br />
  <input type="password" name="password" placeholder="Password"><br />
  <input type="text" name="firstname" placeholder="First Name"><br />
  <input type="text" name="lastname" placeholder="Last Name"><br />
  <input type="text" name="address" placeholder="Address"><br />
  <input type="text" name="email" placeholder="Email"><br />
  <input type="text" name="phone" placeholder="Phone Number"><br />
  <input type="submit" name="submit">
</form>
</body>
</html>
