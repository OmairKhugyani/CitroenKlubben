<?php
include_once("header.php");
session_start();

if (!isset($_SESSION["localID"])) {
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
      <h3><?= $_SESSION["localID"] ?></h3>
    </div>
    <div>
      <h6>Rettigheder</h6>
      <h3><?= $_SESSION["MemberRole"] ?></h3>
    </div>
    <div class="width-100 container">
      <a class="link-remove btn btn-gray" href="editUser.php"><svg class="svg-user-edit"></svg>Rediger bruger</a>
    </div>
  </div>
  <main class="box-content-padding">

    <div class="box-center">
      <h3 class="margin-bottom-0">Se medlemmer</h3>
    </div>
    <div class="small-row container_space-around margin-bottom-1 max-with-800">
      <a class="link-remove btn margin-x-auto" href="klubList.php"><svg class="svg-user"></svg>Egen klub</a>
      <a class="link-remove btn margin-x-auto" href="klubList.php"><svg class="svg-user-more"></svg>Alle klubber</a>
    </div>

    <?php
    if ($_SESSION["admin"] || $_SESSION["regionAdmin"]) { ?>
      <div class="box-center">
        <h3 class="margin-bottom-0">Medlemshåndtering</h3>
      </div>
      <div class="small-row max-with-800 container_space-around margin-bottom-1">
        <a class="link-remove btn btn-white-greenhover margin-x-auto" href="createUser.php"><svg class="svg-user-add"></svg>Tilføj medlem</a>
        <a class="link-remove btn btn-white-redhover margin-x-auto" href="deleteUser.php"><svg class="svg-user-remove"></svg>Fjern medlem</a>
      </div>
    <?php } ?>

    <div class="box-center">
      <h3 class="margin-bottom-0">Data udtræk</h3>
    </div>
    <div class="container_space-around margin-bottom-1">
      <a class="link-remove btn margin-x-auto"><svg class="svg-doc"></svg>Udtræk klub data</a>
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