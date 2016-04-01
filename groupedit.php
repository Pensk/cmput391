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
      $groupinfo = $group->getInfo($groupid);
    ?>
    <h2>Edit Group</h2><br />
    <h4>Name</h4>
    <form class="form" action="server/groupname.php" method="POST">
      <input type="text" value="<?= $groupinfo["group_name"] ?>" name="groupname" />
      <input type="submit" name="submit" value="Update Name" />
    </form>
    <ul>
      <?php
        foreach($group->getMembers($groupid) as $member){
          echo "<li>".$member['user_name']."<span class='badge'><a href='server/groupdeleteuser?id=".$member['user_name']."'>X</a></span></li>";
        }
      ?>
    </ul>
    <?php
      endif;
    ?>
  </div>

<?php
  include_once('template/footer.php');
?>
