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
          $templist=" (imgaes.subject like ".$thelist[0]." or imgaes.place like ".$thelist[0]." or images.description like ".$thelist[0].")";
        }
        else{
          $templist=$templist." and (images.(namevalue) like ".$thelist[$temp]." or images.place like ".$thelist[$temp]." or images.description like ".$thelist[$temp].")";
        }
      }
    }
    if($startdate!=""){
      $tempstartdate=" images.timing>".$startdate;
      if($keys!=0){
        $tempstartdate=" and".$tempstartdate
      }
    }
    if($enddate!=""){
      $tempenddate=" images.timing<".$enddate;
      if($keys!=0){
        $tempenddate=" and".$tempenddate
      }
    }
    if($keys==0 and $startdate=="" and $enddate==""){
      $sql="select * from images"
      //execute
    }else{
      $sql="select * from images where".$templist.$tempstartdate.$tempenddate;
      //execute
    }
  }
?>
