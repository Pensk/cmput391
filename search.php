<?php
// if logged in...
  session_start();
  if(!isset($_SESSION["user"])){
    header('Location: login.php');
  }

  $user = $_SESSION["user"];

  if(isset($_GET["submit"])){
    //to search the images
    include_once('module/module.search.php');
    $search = new Search;
    //to check permissions
    include_once('module/module.display.php');
    $disp = new Display;

    $searchtext = $_GET["searchtext"];
    $keywords = explode(' ',$searchtext);
    $keyword = false;
    $date = false;

    $startdate = $_GET["startdate"];
    $enddate = $_GET["enddate"];

    if(isset($_GET["keyword"]))
      $keyword = true;
    if(isset($_GET["date"]))
      $date = true;

    $result = $search->search($keyword,$date,$keywords,$startdate,$enddate);
    // link to display
  }

  $pageTitle = "Search Page";

  include_once('template/header.php');
?>
  <div class="container">
    <h2>Image Search</h2>
<form method="GET" clas="form">
  <div class="form-group">
    <input class="form-control" type="text" name="searchtext" placeholder="Keywords (separate by space)"><br />
    <input class="form-control" type="date" name="startdate" placeholder="Start Date Y-M-D"><br />
    <input class="form-control" type="date" name="enddate" placeholder="End Date Y-M-D">
  </div>
  <div class="form-group">
    <div class="checkbox">
    <label>
      <input type="checkbox" name="keyword"> Search by Keyword
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="date"> Search by Date
    </label>
  </div>
  </div>
  <div class="form-group">
    <input class="form-control" type="submit" name="submit" value="Search">
  </div>
  </form>
  <hr />
  <div class="row">
  <?php
  if(isset($result)):
    $c = 0;
    foreach($result as $img):
      if($disp->canView($user,$img["photo_id"])):
      if($c % 3 == 0)
        echo "</div>\n<div class='clearfix'></div><br />\n<div class='row'>";
  ?>
  <div class="col-md-4 text-center">
  <a href="display.php?id=<?= $img["photo_id"] ?>">
  <img src="server/image.php?id=<?= $img["photo_id"] ?>" class="center-block" width="100" height="100"/><br />
  <h4><strong><?= $img["description"] ?></strong></h4><br /><?= $img["owner_name"] ?>
  </a>
  </div>
<?php
      $c += 1;
      endif;
    endforeach;
  endif;
  ?>
</div>
</div>
<?php
  include_once('template/footer.php');
?>
