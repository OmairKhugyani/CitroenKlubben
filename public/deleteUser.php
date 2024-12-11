<?php
include("header.php");

#include("./classes/Member.php");
$tableHeaders = [
  "Medlems Nr.",
  "Navn",
  "Efternavn",
  "Adresse",
  "2. Adresse",
  "Post Nr.",
  "By",
];
$member = [
  "id" => 12,
  "name" => "tom",
  "lastname" => "hansen",
  "address" => "lillevangsvej 2, 2mf",
  "address2" => "",
  "postnumber" => 2323,
  "city" => "København",
  // $email = "tom@mail.com";
  // $phone = 232323;
];
$memberList = [
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
  $member,
]
?>

<div class="container container-xl box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Slet bruger</h1>
  <div class="infobar-container">
    <div>
      <label for="klub">Klub</label>
      <div class="select-wrapper">
        <select name="klub" id="klub" required>
          <?php include("klubOptions.php") ?>
        </select>
      </div>
    </div>
    <div>
      <h6>Antal medlemmer</h6>
      <h3><?= count($memberList) ?></h3>
    </div>
  </div>
  <main class="box-content-padding box-center flex">
    <div class="container-table-overflow">
      <div class="table-head">
        <?php foreach ($tableHeaders as $heading) { ?>
          <p><?= $heading ?></p>
        <?php } ?>
      </div>
      <div>
        <?php foreach ($memberList as $item) { ?>
          <div class="table-row">
            <p><?= $item["id"] ?></p>
            <p><?= $item["name"] ?></p>
            <p><?= $item["lastname"] ?></p>
            <p><?= $item["address"] ?></p>
            <p><?= $item["address2"] ?></p>
            <p><?= $item["postnumber"] ?></p>
            <p><?= $item["city"] ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>
</div>

<?php
include("footer.php");
?>