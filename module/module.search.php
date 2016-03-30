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
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->db = new PDO($dsn, DB_USER, DB_PASS, $opt);
    }
  } 
  function search($thelist=array(),$keys=0,$startdate="",$enddate=""){
    $templist="";$tempstartdate="";$tempenddate="";
    if($keys!=0){
      for($temp=0;$temp<$keys;%temp++){
        if($temp==0){
          $templist=" (table).(namevalue) like ".$thelist[0];
        }
        else{
          $templist=$templist." and (table).(namevalue) like ".$thelist[$temp];
        }
      }
    }
    if($startdate!=""){
      $tempstartdate=" (table).(datevalue)>".$startdate
    }
    if($enddate!=""){
      $tempenddate=" (table).(datevalue)<".$enddate
    }
    if($keys==0 and $startdate=="" and $enddate==""){
      $sql="select * from (table)"
      //execute
    }else{
      $sql="select * from (table) where".$templist.$tempstartdate.$tempenddate
      //execute
    }
  }
?>
