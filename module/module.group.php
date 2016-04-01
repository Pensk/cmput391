<?php
  include_once('constants.php');


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

    //return groups a user is in
    public function groupsIn($user) {
      $sql = "SELECT * FROM groups join group_lists on group_lists.group_id = groups.group_id WHERE friend_id = :user";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["user"=>$user]);
      return $stmt->fetchAll();
    }

    //return true if a user owns a specific group
    public function isOwner($user,$groupid) {
      $sql = "SELECT user_name as user FROM groups WHERE group_id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["id"=>$groupid]);
      return $stmt->fetch()["user"] == $user;
    }

    //Create a new group
    public function createGroup($user,$name){
      $sql = "INSERT INTO groups (user_name, group_name, date_created) VALUES (:user, :name, now())";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["user"=>$user,"name"=>$name]);
    }

    //Return information on a group from its ID
    public function getInfo($groupid){
      $sql = "SELECT * FROM groups where group_id = :groupid";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["groupid"=>$groupid]);
      return $stmt->fetch();
    }

    //Return the members of a group
    public function getMembers($groupid){
      $sql = "SELECT friend_id FROM group_lists where group_id = :groupid";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["groupid"=>$groupid]);
      return $stmt->fetchAll();
    }

    //Set the name of a group using the id
    public function setName($groupid, $groupname) {
      $sql = "UPDATE groups SET group_name = :groupname where group_id = :groupid";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["groupname"=>$groupname,"groupid"=>$groupid]);
    }

    //Delete a group
    public function deleteGroup($groupid) {
      $sql = "DELETE FROM groups where group_id = :groupid";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(["groupid"=>$groupid]);
    }

  }
?>
