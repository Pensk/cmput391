<?php
  session_start();

  //Check if the form was submitted
  if(isset($_POST['submit']))
  {
    //Make an instance of the User class
    include_once("module/module.user.php");
    $user = new User;

    //fetch all the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    //Register a new user with it
    $user->register($username,$password,$firstname,$lastname,$address,$email,$phone);
    //Send them to login
    header('Location: login.php');
  }
  $pageTitle = "Register";
?>

<?php
include_once('template/header.php');
?>
<div class="container">
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
</div>
<?php
include_once('template/footer.php');
?>
