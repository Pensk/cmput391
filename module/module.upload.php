<?php

include_once("constants.php");

//Upload Module used to insert images into the database
Class Upload {

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

  public function uploadImage($user,$image){
    $sql = "INSERT INTO images (owner_name, thumbnail, photo) VALUES (:username, :thumb, :photo";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["username"=>$user,"thumb"=>$image,"photo"=>$image]);
  }

}
?>
