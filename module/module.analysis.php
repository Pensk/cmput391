<?php
//search module
include_once('module.database.php');

Class Analysis {

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
}
?>
