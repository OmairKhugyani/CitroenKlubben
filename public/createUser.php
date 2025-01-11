<?php
include("header.php");
require '../config.php';
require '../models/Club.php';
require '../models/Member.php';
require '../models/ClubRelation.php';
require '../models/Responsibilities.php';
require '../models/MemberRoles.php';

session_start();

$club = new Club($db);
$clubs = $club->getAllClubs();
$clubRelation = new ClubRelation($db);

$responsibilities = new Responsibilities($db);
$allRoles = $responsibilities->getAllResponsibilities();

$memberRole = new MemberRoles($db);

$member = new Member($db);

$data_text_type = [
  //[ name & id & for, label & placeholder, type ]
  // ['localMemberID', 'Lokal klub ID', 'text'],
  ['firstName', 'Fornavn', 'text'],
  ['lastName', 'Efternavn', 'text'],
  ['email', 'Mail', 'email'],
  ['membershipPaidUntil', 'Medlemsskabs slut dato', 'date'],
  ['youthMembership', 'Ungdoms medlemsskab', 'checkbox'],
  ['youthMembershipYear', 'Ungdoms medlemsskab frast', 'date'],
  ['regionAdmin', 'Klub admin', 'checkbox'],
  ['admin', 'Admin', 'checkbox'],
  ['password', 'Midlertidigt kode ord', 'password'],
]

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
            <?php
            foreach ($clubs as $clubItem) {
            ?>
              <option value="<?= $clubItem["ClubID"] ?>"><?= $clubItem["ClubName"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>
      <div class="box-input-container">
        <label for="role">Medlems rolle</label>
        <div class="select-wrapper">
          <select name="role" id="role">
            <?php
            foreach ($allRoles as $role) {
            ?>
              <option value="<?= $role["RoleID"] ?>" <?= $role["Role"] === 'Medlem' ? 'selected' : '' ?>><?= $role["Role"] ?></option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>
      <?php
      for ($input_feild = 0; $input_feild <= count($data_text_type) - 1; $input_feild++) { ?>
        <div class="box-input-container">
          <?php if ($data_text_type[$input_feild][2] == "checkbox") { ?>
            <!-- checkbox use defriens layout -->
            <label class="checkbox_container" for="<?= $data_text_type[$input_feild][0] ?>">
              <?= $data_text_type[$input_feild][1] ?>
              <input type="checkbox" name="<?= $data_text_type[$input_feild][0] ?>" id="<?= $data_text_type[$input_feild][0] ?>">
              <span class="checkmark"></span>
            </label>
          <?php } else { ?>
            <label for="<?= $data_text_type[$input_feild][0] ?>"><?= $data_text_type[$input_feild][1] ?></label>
            <input type="<?= $data_text_type[$input_feild][2] ?>" id="<?= $data_text_type[$input_feild][0] ?>" name="<?= $data_text_type[$input_feild][0] ?>" placeholder="<?= $data_text_type[$input_feild][1] ?>" <?= $data_text_type[$input_feild][0] == 'youthMembershipYear' ? '' : 'required'; ?>>
          <?php } ?>
        </div>
      <?php
      }
      ?>
      <div class="box-input-container box-center">
        <button class="btn-white-greenhover" name="CreateUser" type="submit">Opret medlem</button>
      </div>
    </form>
  </main>
</div>

<?php
include("footer.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $clubMemberCount = count($clubRelation->getClubRelationsByClub($_POST["club"]));
  $data = [                     // Makes local MemberID: club Abbreviation + (number of members in club + 1)
    'localMemberID'          => "{$clubs[$_POST["club"] - 1]["Abbreviation"]}" . strval(str_pad($clubMemberCount + 1, 3, 0, STR_PAD_LEFT)),
    'firstName'              => $_POST["firstName"],
    'lastName'               => $_POST["lastName"],
    'address1'               => null,
    'address2'               => null,
    'postalCode'             => null,
    'city'                   => null,
    'phone'                  => null,
    'email'                  => $_POST["email"],
    'directDebitAgreement'   => 0,
    'membershipPaidUntil'    => $_POST["membershipPaidUntil"],
    'youthMembership'        => isset($_POST["youthMembership"]) ? true : false,
    'youthMembershipYear'    => $_POST["youthMembershipYear"],
    'apua'                   => null,
    'regionAdmin'            => isset($_POST["regionAdmin"]) ? true : false,
    'admin'                  => isset($_POST["Admin"]) ? true : false,
    'allowRegion'            => 0,
    'allowAll'               => 0,
    'passWord'               => password_hash($_POST["password"], PASSWORD_DEFAULT),
    'passWordChanged'        => 0,
  ];

  try {
    $newUser = $member->createMember($data);
    $clubRelation->createClubRelation(['memberID' => $newUser["MemberID"], 'clubID' => $_POST["club"]]);
    $memberRole->createMemberRole(['roleID' => $_POST["role"], 'memberID' => $newUser["MemberID"]]);
    echo "<script>alert('nyt medlem tilføjet')</script>";
  } catch (Exception $ex) {
    echo "<script>console.log({'$ex'})</script>";
    echo "<script>alert('kunne ikke oprette bruger')</script>";
    exit;
  }
}
?>