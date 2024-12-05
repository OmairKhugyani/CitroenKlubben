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

// Nordvestjysk
// Midtjylland
// Sydvestjysk
// Djursland
// Trekanten
// Fyn
// Citroënisterne – primært Nordsjælland og København
// De Flyvende Citroner – øvrige Sjælland og Bornholm
// Sydhavsøerne


// Modelrelaterede klubber

// CX-club
// HY-TEAM
// MEHARI-gruppen
// Berlingo /C1
// Club Citroën C6 Danmark
// Dansk Citroën SM Klub
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
            <option value="" selected disabled hidden>Vælg en klub</option>
            <optgroup class="h5" label="Lokale klubber">
            <optgroup label="Jylland">
              <option value="1">Nordvestjysk</option>
              <option value="2">Midtjylland</option>
              <option value="3">Sydvestjysk</option>
              <option value="4">Djursland</option>
              <option value="5">Trekanten</option>
              <option value="7">Citroënisterne <span class="text-small">- primært Nordsjælland og København</span></option>
            </optgroup>
            <optgroup label="Sjæland">
              <option value="8">De Flyvende Citroner <span class="text-small">- øvrige Sjælland og Bornholm</span></option>
              <option value="7">Citroënisterne <span class="text-small">- primært Nordsjælland og København</span></option>
            </optgroup>
            <optgroup label="Øvrige Danmark">
              <option value="6">Fyn</option>
              <option value="8">De Flyvende Citroner <span class="text-small">- øvrige Sjælland og Bornholm</span></option>
              <option value="9">Sydhavsøerne</option>
            </optgroup>
            </optgroup>
            <optgroup class="h5" label="Model klubber">
              <option value="10">CX-club</option>
              <option value="11">HY-TEAM</option>
              <option value="12">MEHARI-gruppen</option>
              <option value="13">Berlingo /C1</option>
              <option value="14">Club Citroën C6 Danmark</option>
              <option value="15">Dansk Citroën SM Klub</option>
            </optgroup>
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