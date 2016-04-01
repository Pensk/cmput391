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
      <div class="form-group">
      <input class="form-control" type="hidden" value="<?= $groupinfo["group_id"] ?>" name="groupid" />
      <input class="form-control" type="text" value="<?= $groupinfo["group_name"] ?>" name="groupname" />
      <input class="form-control" type="submit" name="submit" value="Update Name" />
      </div>
    </form>
    <br />
    <h4>Group Members</h4>
    <br />
    <ul class="list-group">
      <?php
        foreach($group->getMembers($groupid) as $member){
          echo "<li class='list-group-item'>".$member['friend_id']."<span class='badge'><a href='server/groupdeleteuser?id=".$member['friend_id']."&groupid=".$groupid."'>Delete</a></span></li>";
        }
      ?>
    </ul>
    <br />
    <form class="form" method="POST" action="server/groupadduser.php">
      <div class="form-group">
        <input class="form-control" type="hidden" value="<?= $groupinfo["group_id"] ?>" name="groupid" />
        <input class="form-control" type="text" name="username" placeholder="User Name" />
        <input class="form-control" type="submit" name="submit" value="Add User" />
      </div>
    </form>
    <br />
    <a href="server/groupdelete.php?id=<?= $groupinfo["group_id"] ?>" class="btn btn-danger">Delete Group</a>
    <?php
      endif;
    ?>
  </div>

<?php
  include_once('template/footer.php');
?>
