<?php
session_start();
if (!isset($_SESSION["localID"])) {
  session_destroy();
  header('Location: index.php');
  exit;
}
require("../controller/MemberController.php");
$MemberController = new MemberController($db);
$tableHeaders = [
  "",
  "Medlems Nr.",
  "Navn",
  "Efternavn",
  "Adresse",
  "Post Nr.",
  "By",
];
ob_start();
include("header.php");
?>

<div class="container container-xl box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Slet bruger</h1>
  <div class="infobar-container">
    <div>
    </div>
    <div>
      <h6>Antal medlemmer</h6>
      <h3><?= count($MemberController->GetAllMember()) ?></h3>
    </div>
  </div>
  <main class="box-content-padding box-center flex">
    <div class="container-table-overflow">
      <div class="table-head delete-table-head">
        <?php foreach ($tableHeaders as $heading) { ?>
          <p><?= $heading ?></p>
        <?php } ?>
      </div>
      <div>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="delete-member">
          <?php foreach ($MemberController->GetAllMember() as $item) { ?>
            <div class="table-row delete-table-row delete-hover">
              <button class="btn-delete p" name="deleteUser" type="submit" value="<?= $item->memberID ?>">Fjen</button>
              <p><?= $item->localMemberID ?></p>
              <p><?= $item->firstName ?></p>
              <p><?= $item->lastName ?></p>
              <p><?= $item->address1 ?></p>
              <p><?= $item->postalCode ?></p>
              <p><?= $item->city ?></p>
            </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </main>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $MemberController->DeleteMemberByID($_POST["deleteUser"]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
  } catch (Exception $ex) {
    echo "<script>alert('kunne ikke slette bruger')</script>";
  }
}
include("footer.php");
ob_end_flush();
?>