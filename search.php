<?php
// if logged in...
  session_start();
  if(isset($_POST["submit"])){
    $searchtext = $_POST["Searchtext"];
    $thelist = explode(' ',$searchtext);
    $keys = count($thelist);
    $tp = $_POST["Timeperiod"];
    //if $keys==0....
    //$query='select * from [img_data_table] where [img_data_table].name like $thelist(1).....
    //
    //
    //link to ora module
  }else{
    // to search page
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
    <input type="submit" name="submit">
  </form>
  </body>
</html>
