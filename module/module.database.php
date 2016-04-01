<?php
  include_once('constants.php');

  class Database{

    public $pdo;
    public $conn;

    function __construct(){
      $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.';charset=UTF8';
      $opt = array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      );
      $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $opt);
    }
  }
?>
