<?php
session_start();
include("header.php");
require("../config.php");
require("../models/Member.php");
require '../models/Club.php';
require '../models/ClubRelation.php';


$club = new CLub($db);
$clubRelation = new ClubRelation($db);
$userClub = $clubRelation->getClubRelationsByMemberID($_SESSION["MemberID"]);

$userClubID = $userClub[0]["ClubID"];
$AllMembers = $club->getAllMembersByClubId($userClubID);

$tableHeaders = [
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
  <h1>Medlems liste</h1>
  <div class="infobar-container">
    <div>
      <h6>Klub ID</h6>
      <h3><?= $_SESSION["localID"] ?></h3>
    </div>
    <div>
      <h6>Antal medlemmer</h6>
      <h3><?= count($AllMembers) ?></h3>
    </div>
  </div>
  <main class="box-content-padding box-center flex">
    <div class="container-table-overflow">
      <h4>Egen klub</h4>
      <div class="table-head">
        <?php foreach ($tableHeaders as $heading) { ?>
          <p><?= $heading ?></p>
        <?php } ?>
      </div>
      <div>
        <?php foreach ($AllMembers as $item) { ?>
          <div class="table-row">
            <p><?= $item["LocalMemberID"] ?></p>
            <p><?= $item["FirstName"] ?></p>
            <p><?= $item["LastName"] ?></p>
            <p><?= $item["Address1"] ?></p>
            <p><?= $item["Address2"] ?></p>
            <p><?= $item["PostalCode"] ?></p>
            <p><?= $item["City"] ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>
</div>

<?php
include("footer.php");
?>