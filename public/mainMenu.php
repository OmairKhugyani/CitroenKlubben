<?php
session_start();
include_once("header.php");

if (!isset($_SESSION) || $_SESSION["LogIn"] !== true) {
  session_destroy();
  header('Location: index.php');
  exit;
}

?>
<div class="container container-lg box-bg-gradient">
  <form action="mainMenu.php" method="post">
    <button type="submit" class="btn-small" name="LogOut"><svg class="svg-door"></svg>Log af</button>
  </form>
  <h1>Hovedmenu</h1>
  <div class="infobar-container">
    <div>
      <h6>Bruger</h6>
      <h3><?= $_SESSION["username"] ?></h3>
    </div>
    <div>
      <h6>Rettigheder</h6>
      <h3>Klubadmin</h3>
    </div>
  </div>
  <main class="box-content-padding">

    <div class="box-center">
      <h3 class="margin-bottom-0">Se medlemmer</h3>
    </div>
    <div class="container_space-around margin-bottom-1">
      <a class="link-remove btn" href="klubList.php"><svg class="svg-user"></svg>Egen klub</a>
      <a class="link-remove btn" href="klubList.php"><svg class="svg-user-more"></svg>Alle klubber</a>
    </div>

    <div class="box-center">
      <h3 class="margin-bottom-0">Medlemshåndtering</h3>
    </div>
    <div class="container_space-around margin-bottom-1">
      <a class="link-remove btn btn-white-greenhover" href="createUser.php"><svg class="svg-user-add"></svg>Add medlem</a>
      <a class="link-remove btn btn-white-redhover" href="deleteUser.php"><svg class="svg-user-remove"></svg>Fjen medlem</a>
    </div>

    <div class="box-center">
      <h3 class="margin-bottom-0">data udtræk</h3>
    </div>
    <div class="container_space-around margin-bottom-1">
      <a class="link-remove btn"><svg class="svg-doc"></svg>Udtræk klub data</a>
    </div>
  </main>
</div>
<?php
include("footer.php");

if (isset($_POST["LogOut"])) {
  session_destroy();
  header("Location: index.php");
}
?>