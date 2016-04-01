<?php
  session_start();

  if(!isset($_SESSION["user"])){
    header('Location: login.php');
  }
  $user = $_SESSION["user"];
  $groupid = $_GET["id"];

  include_once('module/module.group.php');
  $group = new Group;

  $pageTitle = "Edit Group";
  include_once('template/header.php');
?>

  <div class="container">
    <?php
      if(!$group->isOwner($user,$groupid)):
    ?>
    <h3>Error - You don't have permission to edit this group.</h3>
    <?php
      else:
    ?>
    <h2>Edit Group</h2>

    <?php
      endif;
    ?>
  </div>

<?php
  include_once('template/footer.php');
?>
