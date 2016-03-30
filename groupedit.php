<?php
  session_start();

  if(!isset($_SESSION["user"])){
    header('Location: login.php');
  }
  $user = $_SESSION["user"];

  include_once('module/module.group.php');
  $group = new Group;

  $pageTitle = "Edit Group";
  include_once('template/header.php');
?>
<body>
  <div class="container">
    <h2>Edit Group</h2>
    
  </div>
</body>
<?php
  include_once('template/footer.php');
?>
