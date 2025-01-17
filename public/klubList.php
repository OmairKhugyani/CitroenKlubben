<?php
session_start();
if (!isset($_SESSION["localID"])) {
  session_destroy();
  header('Location: index.php');
  exit;
}
include("header.php");
include '../controller/MemberController.php';
$memberController = new MemberController($db);

$tableHeaders = [
  "Medlems Nr.",
  "Navn",
  "Efternavn",
  "Adresse",
  "2. Adresse",
  "Post Nr.",
  "By"
];
$tableHeaders = [
  "Medlems Nr.",
  "Navn / Efternavn",
  "Adresse / 2. Adresse",
  "Post Nr. / By"
];
?>


<div class="container container-xl box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Medlems liste</h1>
  <div class="infobar-container">
    <div>
      <h6>Klub ID</h6>
      <h3><?= $_SESSION["localID"] ?></h3>
    </div>
    <div>
      <h6>Antal medlemmer</h6>
      <h3><?= count($memberController->GetAllMember()) ?></h3>
    </div>
  </div>
  <main class="box-content-padding box-center flex">
    <!--     
    <div class="container-table-overflow">
      <h4>Alle klubber</h4>
      <div class="table-head">
        <?php foreach ($tableHeaders as $heading) { ?>
          <p><?= $heading ?></p>
        <?php } ?>
      </div>
      <div>
        <?php foreach ($memberController->GetAllMember() as $item) { ?>
          <div class="table-row">
            <p><?= $item->localMemberID; ?></p>
            <p><?= $item->firstName; ?></p>
            <p><?= $item->lastName; ?></p>
            <p><?= $item->address1; ?></p>
            <p><?= $item->address2; ?></p>
            <p><?= $item->postalCode; ?></p>
            <p><?= $item->city; ?></p>
          </div>
        <?php } ?>
      </div>
    </div> -->


    <div class="container-table-overflow">
      <h4>Alle klubber</h4>
      <div class="table-head table-head-v2">
        <?php foreach ($tableHeaders as $heading) { ?>
          <p><?= $heading ?></p>
        <?php } ?>
      </div>
      <div>
        <?php foreach ($memberController->GetAllMember() as $item) { ?>
          <div class="table-row table-row-v2">
            <div class="box-center">
              <p><?= $item->localMemberID; ?></p>
            </div>
            <div>
              <p><?= $item->firstName; ?></p>
              <p><?= $item->lastName; ?></p>
            </div>
            <div>
              <p><?= $item->address1; ?></p>
              <p><?= $item->address2; ?></p>
            </div>
            <div>
              <p><?= $item->postalCode; ?></p>
              <p><?= $item->city; ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>


  </main>
</div>

<?php
include("footer.php");
?>