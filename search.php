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
  <div class="container">
<form method="POST">
    <input type="text" name="searchtext" placeholder="Searchtext"><br />
    <input type="date" name="startdate" placeholder="Startdate yyyy/mm/dd"><br />
    <input type="date" name="enddate" placeholder="Enddate yyyy/mm/dd">
    <input type="submit" name="submit">
  </form>
  <hr />
  <div class="row">
  <?php foreach($result as $img):  ?>
  <div class="col-md-4 text-center">
  <img src="server/image.php?id=<?= $img["photo_id"] ?>" class="img-responsive" /><br />
  <h4><strong><?= $img["description"] ?></strong></h4> - <?= $img["owner_name"] ?>
  </div>
<?php endforeach; ?>
  </div>
</div>
  </body>
<?php
  include_once('template/footer.php');
?>
