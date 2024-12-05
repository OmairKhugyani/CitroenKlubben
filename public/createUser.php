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
            <optgroup label="Midt Jylland">
              <option value="1">Citroen</option>
              <option value="2">VW</option>
            </optgroup>
            <optgroup label="Fyn">
              <option value="3">Volvo</option>
              <option value="4">GM</option>
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