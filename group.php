<?php
  session_start();

  if(!isset($_SESSION["user"])){
    header('Location: login.php');
  }
  $user = $_SESSION["user"];

  include_once('module/module.group.php');
  $group = new Group;

  $pageTitle = "Groups";
  include_once('template/header.php');
?>

  <div class="container">
    <h2>Group Page</h2>
    <div class="row">
      <div class="col-md-6">
        <p>You own these groups:</p>
        <ul>
          <?php
            foreach($group->groupsOwned($user) as $g){
              echo "<li><a href='groupedit.php?id=".$g["group_id"]."'>".$g["group_id"].": ".$g["group_name"]." - created: ".$g["date_created"]."</a></li>";
            }
          ?>
        </ul>
      </div>
      <div class="col-md-6">
        <p>You belong to these groups:</p>
        <ul>
          <?php
            foreach($group->groupsIn($user) as $g){
              echo "<li>".$g["group_id"].": ".$g["group_name"]." - created: ".$g["date_created"]."</li>";
            }
          ?>
        </ul>
      </div>
    </div>
  </div>

<?php
  include_once('template/footer.php');
?>
