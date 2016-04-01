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
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->db = new PDO($dsn, DB_USER, DB_PASS, $opt);
    }
  }

  //return an array of all the images in the database
  public function canView($user,$imgid){

    //admin can view all images
    if($user == "admin"){
      return true;
    }

    $sql = "SELECT owner_name, permitted from images where images.photo_id = :imgid";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["imgid"=>$imgid]);
    $data = $stmt->fetch();

    //The owner of the image can always see it (private or otherwise)
    if($data["owner_name"] == $user){
      return true;
    }

    //public images may be viewed by anyone
    if($data["permitted"] == 1){
      return true;
    }

    //Select the row if the user is in the group the image belongs to
    $sql = "SELECT COUNT(*) as count FROM images join groups on permitted = groups.group_id join group_lists on group_lists.group_id = groups.group_id where friend_id = :user and photo_id = :imgid";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["user"=>$user, "imgid"=>$imgid]);
    //return whether or not that row exists
    return $stmt->fetch()["count"] > 0;

  }

  public function getImageFromId($imgid){
    $sql = "SELECT photo FROM images WHERE photo_id = :imgid";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["imgid"=>$imgid]);
    return $stmt->fetch()["photo"];
  }

}
?>
