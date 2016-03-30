<?php
  //Group module for handling managing user Groups

  Class Group {

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

    //return groups owned by a user
    public function groupsOwned($user) {
      $sql = "SELECT * FROM groups WHERE user_name = :user";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["user"=>$user]);
      return $stmt->fetchAll();
    }

  }
?>
