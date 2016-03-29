<?php
include_once('constants.php');
//display module for displaying images from the database

Class Display {

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

  //return an array of all the images in the database
  public function displayImages(){
    $sql = "SELECT * FROM images";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getImageFromId($imgid){
    $sql = "SELECT photo FROM images WHERE photo_id = :imgid";
    $stmt = $this->db->prepare($sql);
    $stmt->execute("imgid"=>$imgid);
    return $stmt->fetch()["photo"];
  }

}
?>
