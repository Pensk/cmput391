<?php
  include_once('module.database.php');


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
          $this->db = new Database;
      }
    }

    //return groups owned by a user
    public function groupsOwned($user) {
      $sql = "SELECT * FROM groups WHERE user_name = :user";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["user"=>$user]);
      return $stmt->fetchAll();
    }

    //return groups a user is in
    public function groupsIn($user) {
      $sql = "SELECT * FROM groups join group_lists on group_lists.group_id = groups.group_id WHERE friend_id = :user";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["user"=>$user]);
      return $stmt->fetchAll();
    }

    //return true if a user owns a specific group
    public function isOwner($user,$groupid) {
      $sql = "SELECT user_name as user FROM groups WHERE group_id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["id"=>$groupid]);
      return $stmt->fetch()["user"] == $user;
    }

    //Create a new group
    public function createGroup($user,$name){
      $sql = "INSERT INTO groups (user_name, group_name, date_created) VALUES (:user, :name, now())";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["user"=>$user,"name"=>$name]);
      $groupid = $this->db->lastInsertId();

      //Make the owner part of the group as well
      $sql = "INSERT INTO group_lists (group_id, friend_id) VALUES (:groupid, :user)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["user"=>$user,"groupid"=>$groupid]);
    }

    //Return information on a group from its ID
    public function getInfo($groupid){
      $sql = "SELECT * FROM groups where group_id = :groupid";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["groupid"=>$groupid]);
      return $stmt->fetch();
    }

    //Return the members of a group
    public function getMembers($groupid){
      $sql = "SELECT friend_id FROM group_lists where group_id = :groupid";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["groupid"=>$groupid]);
      return $stmt->fetchAll();
    }

    //Set the name of a group using the id
    public function setName($groupid, $groupname) {
      $sql = "UPDATE groups SET group_name = :groupname where group_id = :groupid";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["groupname"=>$groupname,"groupid"=>$groupid]);
    }

    //Delete a group
    public function deleteGroup($groupid) {
      $sql = "DELETE FROM groups where group_id = :groupid";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["groupid"=>$groupid]);
    }

    //Add a user to a group
    public function addUser($groupid,$username){
      $sql = "INSERT INTO group_lists (group_id, friend_id, date_added) VALUES (:groupid, :username, now())";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["groupid"=>$groupid,"username"=>$username]);
    }

    //Delete a user from a group
    public function deleteUser($groupid,$userid){
      $sql = "DELETE FROM group_lists WHERE friend_id = :userid and group_id = :groupid";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["groupid"=>$groupid,"userid"=>$userid]);
    }

  }
?>
