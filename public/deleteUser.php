<?php
session_start();
include("header.php");
require("../config.php");
require("../models/Member.php");
require("../models/Club.php");

$members = new Member($db);
$AllMembers = $members->getAllMembers();

$club = new club($db);
$AllClubs = $club->getAllClubs();

$tableHeaders = [
  "",
  "Medlems Nr.",
  "Navn",
  "Efternavn",
  "Adresse",
  "2. Adresse",
  "Post Nr.",
  "By",
];

?>

<div class="container container-xl box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Slet bruger</h1>
  <div class="infobar-container">
    <div>
    </div>
    <div>
      <h6>Antal medlemmer</h6>
      <h3><?= count($AllMembers) ?></h3>
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
          <?php foreach ($AllMembers as $item) { ?>
            <div class="table-row delete-table-row delete-hover">
              <button class="btn-delete p" name="deleteUser" type="submit" value="<?= $item["MemberID"] ?>">Fjen</button>
              <p><?= $item["LocalMemberID"] ?></p>
              <p><?= $item["FirstName"] ?></p>
              <p><?= $item["LastName"] ?></p>
              <p><?= $item["Address1"] ?></p>
              <p><?= $item["PostalCode"] ?></p>
              <p><?= $item["City"] ?></p>
            </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </main>
</div>

<?php
include("footer.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $members->deleteMember($_POST["deleteUser"]);
  } catch (Exception $ex) {
    echo "<script>alert('kunne ikke slette bruger')</script>";
  }
}
?>