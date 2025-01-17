<?php

session_start();
if (!isset($_SESSION["localID"])) {
  session_destroy();
  header('Location: index.php');
  exit;
}

require '../controller/MemberController.php';
$memberController = new MemberController($db);
$memberController->SetCurrentMemberID();
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
      <div class="box-input-container">
        <label for="firstName">Fornavn</label>
        <input type="text" name="firstName" id="firstName" placeholder="Fornavn" value="<?= $memberController->currentMember->firstName ?>">
      </div>
      <div class="box-input-container">
        <label for="lastName">Efternavn</label>
        <input type="text" name="lastName" id="lastName" placeholder="efternavn" value="<?= $memberController->currentMember->lastName ?>">
      </div>
      <div class="box-input-container">
        <label for="ddress1">Addresse</label>
        <input type="text" name="address1" id="address1" placeholder="Addresse" value="<?= $memberController->currentMember->address1 ?>">
      </div>
      <div class="box-input-container">
        <label for="address2">2. Addresse</label>
        <input type="text" name="address2" id="address2" placeholder="2. Addresse" value="<?= $memberController->currentMember->address2 ?>">
      </div>
      <div class="box-input-container">
        <label for="postalCode">Post nr.</label>
        <input type="number" name="postalCode" id="postalCode" placeholder="Post nr." value="<?= $memberController->currentMember->postalCode ?>">
      </div>
      <div class="box-input-container">
        <label for="city">By</label>
        <input type="text" name="city" id="city" placeholder="By" value="<?= $memberController->currentMember->city ?>">
      </div>
      <div class="box-input-container">
        <label for="phone">Tlf. Nummer</label>
        <input type="number" name="phone" id="phone" placeholder="Tlf. Nummer" value="<?= $memberController->currentMember->phone ?>">
      </div>
      <div class="box-input-container">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" value="<?= $memberController->currentMember->email ?>">
      </div>
      <div class="box-input-container">
        <label class="checkbox_container" for="isApua"> Apua
          <input type="checkbox" name="isApua" id="isApua" <?= $memberController->currentMember->isApua ? 'checked' : '' ?>>
          <span class="checkmark"></span>
        </label>
      </div>
      <div class="box-input-container">
        <label class="checkbox_container" for="allowAll"> Tillad visning til alle medlemmer
          <input type="checkbox" name="allowAll" id="allowAll" <?= $memberController->currentMember->allowAll ? 'checked' : '' ?>>
          <span class="checkmark"></span>
        </label>
      </div>
      <div class="box-input-container">
        <label class="checkbox_container" for="allowRegion"> Tillad visning til medlemmer i samme klub
          <input type="checkbox" name="allowRegion" id="allowRegion" <?= $memberController->currentMember->allowRegion ? 'checked' : '' ?>>
          <span class="checkmark"></span>
        </label>
      </div>
      <div class="box-input-container">
        <label for="passWord">Kode ord</label>
        <input type="password" name="passWord" id="passWord" placeholder="Kode ord">
      </div>

      <div class="box-input-container">
        <button class="btn-white-greenhover margin-x-auto" name="UpdateUser" type="submit">Opdater</button>
      </div>
    </form>

  </main>
</div>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $memberController->UpdateMemberByPost($_POST);
    header("Refresh:0");
    exit;
  } catch (Exception $ex) {
    echo "<script>console.log({'$ex'})</script>";
  }
}
include("footer.php");
?>