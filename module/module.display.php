<?php
include_once('module.database.php');
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
        $this->db = new Database;
    }
  }

  //return true if a user has permission to view an image
  public function canView($user,$imgid){

    //admin can view all images
    if($user == "admin"){
      return true;
    }

    $sql = "SELECT owner_name, permitted from images where images.photo_id = :imgid";
    $stmt = $this->db->pdo->prepare($sql);
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
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(["user"=>$user, "imgid"=>$imgid]);
    //return whether or not that row exists
    return $stmt->fetch()["count"] > 0;

  }

  //return true if a user has permission to edit an image
  public function canEdit($user, $imgid){
    //We'll allow the admin free reign here
    if($user == "admin"){
      return true;
    }

    $sql = "SELECT owner_name from images where images.photo_id = :imgid";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(["imgid"=>$imgid]);
    $data = $stmt->fetch();
    //return true if we are the owner
    return $data["owner_name"] == $user;
  }

  //Return the image BLOB from an id
  public function getImageFromId($imgid) {
    $sql = "SELECT photo FROM images WHERE photo_id = :imgid";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(["imgid"=>$imgid]);
    return $stmt->fetch()["photo"];
  }

  //Return all information about an image by id
  public function getImageInfo($imgid) {
    $sql = "SELECT * FROM images WHERE photo_id = :imgid";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(["imgid"=>$imgid]);
    return $stmt->fetch();
  }

  //Update an image's security/information
  public function updateImage($imgid,$descr,$loc,$time,$subj,$permitted) {
    $sql = "UPDATE images SET description = :descr, place = :loc, timing = :timing, subject = :subj, permitted = :permitted WHERE photo_id = :imgid";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(["descr"=>$descr,"loc"=>$loc,"timing"=>$time,"subj"=>$subj,"imgid"=>$imgid,"permitted"=>$permitted]);
  }

  //delete an image from the database
  public function deleteImage($imgid) {
    $sql = "DELETE FROM images WHERE photo_id = :imgid";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(["imgid"=>$imgid]);
  }

  //Insert a row into the views table, representing a unique view of an image
  public function userViewed($user,$imgid){
    $sql = "INSERT INTO views (user_name, photo_id) VALUES (:user, :img)";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(["user"=>$user,"img"=>$imgid]);
  }

  //return images a user owns
  public function ownsImages($user){
    $sql = "SELECT * FROM images WHERE owner_name = :user";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute(["user"=>$user]);
    return $stmt->fetchAll();
  }

  //Return images ordered by how many views they have
  public function mostPopular(){
    $sql = "SELECT images.photo_id, owner_name, description, COUNT(*) as count FROM views join images on images.photo_id = views.photo_id GROUP BY views.photo_id ORDER BY count DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

}
?>
