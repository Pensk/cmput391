<?php
  session_start()

  if(!isset($_SESSION["user"])){
    header('Location: login.php');
  }
  $user = $_SESSION["user"];

  include_once('module/module.group.php');
  $group = new Group;

  $pageTitle = "Groups";
  include_once('template/header.php');
?>
<body>
  <div class="container">
    <h2>Group Page</h2>
    <div class="row">
      <div class="col-md-6">
        <p>You own these groups:</p>
        <ul>
          <?php
            foreach($group->groupsOwned($user) as $group){
              echo "<li>".$group["group_id"].": ".$group["group_name"]." - created: ".$group["date_created"]."</li>";
            }
          ?>
        </ul>
      </div>
      <div class="col-md-6">
        <p>You belong to these groups:</p>
        <ul>

        </ul>
      </div>
    </div>
  </div>
</body>
<?php
  include_once('template/footer.php');
?>
