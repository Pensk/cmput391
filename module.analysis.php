<?php
//search module
include_once('constants.php');

Class Search {

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
  
  //return true if the user is admin
  public function isAdmin($user) {
  	
  		//only admin can get the access of analysis report
    	if($user == "admin"){
      return true;}
  }
  
  	// should create a view that holds all information needed of this information cube
  	
  //return the number of each user 
  public function userStats ($user ) {
    $sql = "SELECT count(*) FROM images WHERE owner_name = :user";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["user"=>$user]);
    return $stmt->fetch();
  }
  
  //return the number of  each subject 
  public function userStats ($subject ) {
    $sql = "SELECT count(*) FROM images  WHERE subject = :subject";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(["subject"=>$subject]);
    return $stmt->fetch();
  }
  
 //return the number of different hierarchies of time: weekly, monthly or yearly
  public function userStats ($user ) {
  }
  }
?>
