<?php
include("header.php");

#include("./classes/Member.php");
$inputList = [
  ["localMemberID", "Løbenummer", "text"],
  ["firstName", "Fornavn", "text"],
  ["lastName", "Efternavn", "text"],
  ["address1", "Adresse", "text"],
  ["address2", "2. Adresse", "text"],
  ["postalCode", "Post nr.", "number"],
  ["city", "By", "text"],
  ["mail", "Mail", "email"],
  ["phone", "Telefonnummer", "tel"]
];

// Lokale klubber

// 0 none
// 1 Nordvestjysk
// 2 Midtjylland
// 3 Sydvestjysk
// 4 Djursland
// 5 rekanten
// 6 Fyn
// 7 Citroënisterne – primært Nordsjælland og København
// 8 De Flyvende Citroner – øvrige Sjælland og Bornholm
// 9 Sydhavsøerne


// Modelrelaterede klubber

// 10 CX-club
// 11 HY-TEAM
// 12 MEHARI-gruppen
// 13 Berlingo /C1
// 14 Club Citroën C6 Danmark
// 15 Dansk Citroën SM Klub
?>
<div class="container container-lg box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Opret medlem</h1>
  <div class="infobar-container">
  </div>
  <main class="box-content-padding box-center flex">
    <form action="form.php" method="post" id="medlem" class="container flex-direction-column">
      <div class="box-input-container">
        <label for="klub">Klub</label>
        <div class="select-wrapper">
          <select name="klub" id="klub" required>
            <?php include("klubOptions.php") ?>
          </select>
        </div>
      </div>
      <?php
      foreach ($inputList as $item) { ?>
        <div class="box-input-container">
          <label for="<?= $item[0] ?>"><?= $item[1] ?></label>
          <input type="<?= $item[2] ?>" name="<?= $item[0] ?>" id="<?= $item[0] ?>" placeholder="<?= $item[1] ?>" required>
        </div>
      <?php } ?>
      <div class="box-input-container box-center">
        <button class="btn-white-greenhover" type="submit">Opret medlem</button>
      </div>
    </form>
  </main>
</div>

<?php
include("footer.php");
?>