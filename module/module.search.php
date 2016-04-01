<?php
//search module
include_once('module.database.php');

Class Search {

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

  public function search($keyword,$date,$keywords,$startdate,$enddate){
    //Search by Keyword & Date
    if($date){
      $sql = "SELECT * FROM images where timing > :startdate AND timing < :enddate";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute(["startdate"=>$startdate,"enddate"=>$enddate]);
      return $stmt->fetchAll();

    //Search by only Keyword
    } else {
      $sql = "SELECT * FROM images";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    }

    //Test for now - let's start by returning all images in the database


    /*
    $templist="";$tempstartdate="";$tempenddate="";
    if($keys!=0){
      for($temp=0;$temp<$keys;$temp++){
        if($temp==0){
          $templist=" (images.subject like :thelist[0] or imgaes.place like :thelist[0] or images.description like :thelist[0])";
        }
        else{
          $templist=$templist." and (images.(namevalue) like :thelist[$temp] or images.place like :thelist[$temp] or images.description like :thelist[$temp])";
        }
      }
    }
    if($startdate!=""){
      $tempstartdate=" images.timing>:startdate";
      if($keys!=0){
        $tempstartdate=" and :tempstartdate";
      }
    }
    if($enddate!=""){
      $tempenddate=" images.timing<:enddate";
      if($keys!=0){
        $tempenddate=" and :tempenddate";
      }
    }
    if($keys==0 and $startdate=="" and $enddate==""){
      $sql="select * from images";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    }else{
      $sql="select * from images where".$templist.$tempstartdate.$tempenddate;
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll();
    }
    */
  }
}
?>
