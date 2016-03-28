<?php

include_once("constants.php");

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
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.';charset=UTF8';
        $opt = array(
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->db = new PDO($dsn, DB_USER, DB_PASS, $opt);
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
  public function login($name, $pass){

  }

}

?>
