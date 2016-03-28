<?php
//handles post data from the register form, and interacts with the user module
  include_once('../module/module.user.php');
  $user = new User;

  $username = $_POST['username'];
  $password = $_POST['password'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  echo $user->register($username,$password,$firstname,$lastname,$address,$email,$phone);
?>
