<?php
include("header.php");
require '../config.php';
require '../models/Club.php';

$club = new Club($db);
$clubs = $club->getAllClubs();

?>
<div class="container container-lg box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Udtræk Klub Data</h1>
  <div class="infobar-container">
  </div>
  <main class="box-content-padding box-center flex">
    <form action="CSVController.php" method="get" class="container flex-direction-column">
      <!-- Vælg handling -->
      <div class="box-input-container">
        <label for="action">Vælg handling:</label>
        <select name="action" id="action" required>
          <option value="exportClubs">Udtræk kun klubber</option>
          <option value="exportMembersAndClubs">Udtræk medlemmer og klubber</option>
        </select>
      </div>

      <!-- Vælg klub -->
      <div class="box-input-container">
        <label for="club">Vælg klub:</label>
        <div class="select-wrapper">
          <select name="club" id="club">
            <option value="all" selected>Alle klubber</option>
            <?php foreach ($clubs as $clubItem): ?>
              <option value="<?= $clubItem['ClubID'] ?>"><?= $clubItem['ClubName'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <!-- Submit knap -->
      <div class="box-input-container box-center">
        <button class="btn-white-greenhover" type="submit">Eksportér data</button>
      </div>
    </form>
  </main>
</div>

<?php include("footer.php"); ?>
