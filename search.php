<?php
// if logged in...
  session_start();
  if(!isset($_SESSION["user"])){
    header('Location: login.php');
  }

  if(isset($_POST["submit"])){
    include_once('module/module.search.php');
    $search = new Search;
    $searchtext = $_POST["searchtext"];
    $thelist = explode(' ',$searchtext);
    $keys = count($thelist);
    $tps = $_POST["startdate"];
    $tpe = $_POST["enddate"];
    $result = $search->search($thelist,$keys,$tps,$tpe);
    // link to display
  }

  $pageTitle = "Search Page";

  include_once('template/header.php');
?>
<body>
<form method="POST">
    <input type="text" name="searchtext" placeholder="Searchtext"><br />
    <input type="date" name="startdate" placeholder="Startdate yyyy/mm/dd"><br />
    <input type="date" name="enddate" placeholder="Enddate yyyy/mm/dd">
    <input type="submit" name="submit">
  </form>
  <?= var_dump($result) ?>
  </body>
<?php
  include_once('template/footer.php');
?>
