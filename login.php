<?php
  session_start();

  //Check if the form was submitted
  if(isset($_POST["submit"])){
    //Create an instance of the User Class
    include_once("module/module.user.php");
    $user = new User;

    //Get the data from the form sent to the server
    $username = $_POST["username"];
    $password = $_POST["password"];

    //Try logging in with the credentials
    if($user->login($username,$password)){
      //Set the user session variable, and send the user to their profile page
      $_SESSION["user"] = $username;
      header("Location: profile.php");
    } else {
      //If we couldn't login, tell the user there was an issue.
      echo "<script>alert('Incorrect Login');</script>";
    }
  }
  $pageTitle = "Login";
?>

<?php
include_once('template/header.php');
?>
<div class="container">
<h2>Login page</h2>
<br />
<?php
  //Check if the user is already logged in
  if(isset($_SESSION["user"])):
?>

  <h4>You're already logged in.</h4>
  <a href="logout.php"><h4>Log Out</h4></a>

<?php else: ?>

  <form method="POST" class="form">
    <div class="form-group">
    <input class="form-control" type="text" name="username" placeholder="Username"><br />
    <input class="form-control" type="password" name="password" placeholder="Password"><br />
  </div>
  <div class="form-group">
    <input class="form-control" type="submit" name="submit">
  </div>
  </form>
  <a href="register.php"><h3>Register</h3></a>

<?php endif; ?>
</div>
<?php
include_once('template/footer.php');
?>
