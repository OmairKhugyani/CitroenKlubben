<?php
include("header.php");
session_start();
if (!isset($_SESSION["localID"]) && ($_SESSION["regionAdmin"] == true || $_SESSION["admin"] == true)) {
  session_destroy();
  header('Location: index.php');
  exit;
}
require '../controller/MemberController.php';
$memberController = new MemberController($db);

?>
<div class="container container-lg box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Opret medlem</h1>
  <div class="infobar-container">
  </div>
  <main class="box-content-padding box-center flex">
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="medlem" class="container flex-direction-column">

      <div class="box-input-container">
        <label for="klub">Klub</label>
        <div class="select-wrapper">
          <select name="club" id="klub" required>
            <option value="Null" selected disabled hidden>Vælg en klub</option>
            <?php foreach ($memberController->getAllClubs() as $clubItem) { ?>
              <option value="<?= $clubItem->clubID ?>"><?= $clubItem->clubName ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="box-input-container">
        <label for="role">Medlems rolle</label>
        <div class="select-wrapper">
          <select name="role" id="role">
            <?php foreach ($memberController->GetAllResponsibilities() as $role) { ?>
              <option value="<?= $role->roleID ?>" <?= $role->role === 'Medlem' ? 'selected' : '' ?>><?= $role->role ?></option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div class="box-input-container">
        <label for="firstName">Fornavn</label>
        <input type="text" id="firstName" name="firstName" placeholder="Fornavn" required>
      </div>

      <div class="box-input-container">
        <label for="lastName">Efternavn</label>
        <input type="text" id="lastName" name="lastName" placeholder="Efternavn" required>
      </div>

      <div class="box-input-container">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
      </div>

      <div class="box-input-container">
        <label for="membershipPaidUntil">Medlemsskabs slut dato</label>
        <input type="date" id="membershipPaidUntil" name="membershipPaidUntil" placeholder="" required>
      </div>

      <div class="box-input-container">
        <label class="checkbox_container" for="youthMembership">
          Ungdoms medlemsskab
          <input type="checkbox" name="youthMembership" id="youthMembership">
          <span class="checkmark"></span>
        </label>
      </div>

      <div class="box-input-container">
        <label for="youthMembershipYear">Ungdoms medlemsskab frast</label>
        <input type="date" id="youthMembershipYear" name="youthMembershipYear" placeholder="">
      </div>

      <div class="box-input-container">
        <label class="checkbox_container" for="admin">
          Admin
          <input type="checkbox" name="admin" id="admin">
          <span class="checkmark"></span>
        </label>
      </div>

      <div class="box-input-container">
        <label class="checkbox_container" for="regionAdmin">
          Regions Admin
          <input type="checkbox" name="regionAdmin" id="regionAdmin">
          <span class="checkmark"></span>
        </label>
      </div>

      <div class="box-input-container">
        <label for="password">Midlertidigt kode ord</label>
        <input type="password" id="password" name="password" placeholder="Midlertidigt kode ord" required>
      </div>

      <div class="box-input-container box-center">
        <button class="btn-white-greenhover" name="CreateUser" type="submit">Opret medlem</button>
      </div>
    </form>
  </main>
</div>

<?php
include("footer.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $memberController->CreateMember($_POST);
    echo "<script>alert('nyt medlem tilføjet')</script>";
  } catch (Exception $ex) {
    echo "<script>console.log({'$ex'})</script>";
    echo "<script>alert('kunne ikke oprette bruger')</script>";
    exit;
  }
}
?>