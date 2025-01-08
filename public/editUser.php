<?php

use function PHPSTORM_META\type;

require '../controller/MemberController.php';
$memberController = new MemberController($db);

$editState = new $memberController->Member($db);
session_start();
include("header.php");
?>


<div class="container container-lg box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Rediger medlem</h1>
  <div class="infobar-container">
    <div>
      <h6>Bruger</h6>
      <h3><?= $_SESSION["localID"] ?></h3>
    </div>
    <div>
      <h6>Rettigheder</h6>
      <h3><?= $_SESSION["MemberRole"] ?></h3>
    </div>
  </div>

  <main class="box-content-padding box-center flex">
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="container flex-direction-column">
      <?php
      $memberController->GetMemberBySession();
      foreach (get_object_vars($memberController->Member) as $key => $item) {
        if (in_array($key, ["passWordChanged", "isAdmin", "isDistrictAdmin", "youthMembershipYear", "youthMembership", "membershipPaidUntil", "directDebitAgreement", "joinDate", "memberID", "localMemberID"])) {
      ?><input type="text" name="<?= $key ?>" value="<?= $item ?>" hidden>
        <?php
        } elseif (is_bool($item)) { ?>
          <div class="box-input-container">
            <label for="<?= $key ?>" class="checkbox_container">
              <?= $key ?>
              <input type="checkbox" name="<?= $key ?>" <?= $item ? "checked" : "" ?>>
              <span class="checkmark"></span>
            </label>
          </div>
        <?php
        } else { ?>
          <div class="box-input-container">
            <label for="<?= $key ?>"><?= $key ?></label>
            <input type="text" name="<?= $key ?>" placeholder="<?= $key ?>" value="<?= $item ?>">
          </div>
        <?php } ?>
      <?php } ?>
      <div class="box-input-container">
        <button class="btn-white-greenhover margin-x-auto" name="UpdateUser" type="submit">Opdater</button>
      </div>
    </form>

  </main>
</div>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    print_r($memberController->UpdateMember($_POST));
  } catch (Exception $ex) {
    "<script>console.log({'$ex'})</script>";
  }
}
include("footer.php");
?>