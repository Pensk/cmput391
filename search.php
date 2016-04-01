<?php
// if logged in...
  session_start();
  if(!isset($_SESSION["user"])){
    header('Location: login.php');
  }

  if(isset($_GET["submit"])){
    include_once('module/module.search.php');
    $search = new Search;
    $searchtext = $_GET["searchtext"];
    $thelist = explode(' ',$searchtext);
    $keys = count($thelist);
    $tps = $_GET["startdate"];
    $tpe = $_GET["enddate"];
    $result = $search->search($thelist,$keys,$tps,$tpe);
    // link to display
  }

  $pageTitle = "Search Page";

  include_once('template/header.php');
?>
  <div class="container">
    <h2>Image Search</h2>
<form method="GET" clas="form">
  <div class="form-group">
    <input class="form-control" type="text" name="searchtext" placeholder="Searchtext"><br />
    <input class="form-control" type="date" name="startdate" placeholder="Startdate yyyy/mm/dd"><br />
    <input class="form-control" type="date" name="enddate" placeholder="Enddate yyyy/mm/dd">
  </div>
  <div class="form-group">
    <input class="form-control" type="submit" name="submit" value="Search">
  </div>
  </form>
  <hr />
  <div class="row">
  <?php
  if(isset($result)):
    foreach($result as $img):
  ?>
  <div class="col-md-4 text-center">
  <img src="server/image.php?id=<?= $img["photo_id"] ?>" class="img-responsive center-block" width="100" height="100"/><br />
  <h4><strong><?= $img["description"] ?></strong></h4><br /><?= $img["owner_name"] ?>
  </div>
<?php
    endforeach;
  endif;
  ?>
  </div>
</div>
<?php
  include_once('template/footer.php');
?>
