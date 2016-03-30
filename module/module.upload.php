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

  //insert an image into the database
  public function uploadImage($user,$permit,$descr,$loc,$time,$subj,$image){
    $sql = "INSERT INTO images (owner_name, permitted, subject, place, timing, description, thumbnail, photo) VALUES (:username, :permit, :subj, :loc, :timing, :descr, :thumb, :photo)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["username"=>$user,"permit"=>$permit, "subj"=>$subj,
                    "loc"=>$loc,"timing"=>$time,"descr"=>$descr,
                    "thumb"=>$image, "photo"=>$image, ]);
  }

}
?>
