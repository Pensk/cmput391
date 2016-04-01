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
    <br />
    <div class="row">
      <div class="col-md-6">
        <h4>You own these groups: (click to edit)</h4>
        <div class="list-group">
          <?php
            foreach($group->groupsOwned($user) as $g){
              echo "<a href='groupedit.php?id=".$g["group_id"]."' class='list-group-item'>".$g["group_id"].": <strong>".$g["group_name"]."</strong> - created: ".$g["date_created"]."</a>";
            }
          ?>
        </div>
      </div>
      <div class="col-md-6">
        <h4>You belong to these groups:</h4>
        <ul class="list-group">
          <?php
            foreach($group->groupsIn($user) as $g){
              echo "<li class='list=group-item'>".$g["group_id"].": <strong>".$g["group_name"]."</strong> - created: ".$g["date_created"]."</li>";
            }
          ?>
        </ul>
      </div>
    </div>
  </div>

<?php
  include_once('template/footer.php');
?>
