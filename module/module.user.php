<?php

include_once("module.database.php");

//user module & class
//Handles User Login & Registration

Class User {

  //Holds the database object for interacting with the DB
  private $db;

  function __construct($db=NULL){
    //Make a new connection only if we don't have one already.
    if(is_object($db))
    {
        $this->db = $db;
    } else {
        $this->db = new Database;
    }
  }

  //Register a new user with form data from register.php
  public function register($username,$password,$firstname,$lastname,$address,$email,$phone){
    $sql = "INSERT INTO users (user_name, password, date_registered) VALUES (:username, :password, now())";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["username"=>$username,"password"=>$password]);

    $sql = "INSERT INTO persons (user_name, first_name, last_name, address, email, phone) VALUES (:username, :firstname, :lastname, :address, :email, :phone)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["username"=>$username,"firstname"=>$firstname,"lastname"=>$lastname,"address"=>$address,"email"=>$email,"phone"=>$phone]);

  }

  //Check a users login data from login.php with the data stored in the Database
  //return true if the user's data matches
  public function login($name, $pass){
    $sql = "SELECT password FROM users WHERE user_name = :user";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["user"=>$name]);
    return $stmt->fetch()["password"] == $pass;
  }

}

?>
