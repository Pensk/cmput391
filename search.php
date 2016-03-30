<?php
// if logged in...
  
  if(isset($_POST["submit"])){
    include_once(module/module.search.php);
    $searchtext = $_POST["Searchtext"];
    $thelist = explode(' ',$searchtext);
    $keys = count($thelist);
    $tps = $_POST["startdate"];
    $tpe = $_POST["enddate"];
    $result->search($thelist,$keys.$tps,$tpe);
    // link to display 
  }
?>
<html>

<head>
  <title>Search Page</title>
</head>
<body>
<form method="POST">
    <input type="text" name="Searchtext" placeholder="Searchtext"><br />
    <input type="text" name="Timeperiod" placeholder="Timeperiod">
    <input type="text" name="Startdate" placeholder="startdate yy/mm/dd"><br />
    <input type="text" name="enddate" placeholder="enddate yy/mm/dd">
    <input type="submit" name="submit">
  </form>
  </body>
</html>
