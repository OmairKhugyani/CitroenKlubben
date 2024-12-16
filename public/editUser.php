<?php
include("header.php");
require_once("../classes/Member.php");
require_once("../config.php");

// Instans af Member-klassen
$member = new Member($db);

// Kontroller, om der er angivet en MemberID via GET
if (!isset($_GET['MemberID']) || empty($_GET['MemberID'])) {
    echo "<p class='error-message'>Ingen medlems-ID angivet!</p>";
    include("footer.php");
    exit();
}

// Hent eksisterende medlem baseret på ID
$memberData = $member->getMemberById($_GET['MemberID']);

if (!$memberData) {
    echo "<p class='error-message'>Medlem ikke fundet!</p>";
    include("footer.php");
    exit();
}

// Hvis formularen er sendt, opdater medlem
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateData = [
        'memberID' => $_POST['memberID'],
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'address1' => $_POST['address1'],
        'address2' => $_POST['address2'] ?? null,
        'postalCode' => $_POST['postalCode'],
        'city' => $_POST['city'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email']
    ];

    if ($member->updateMember($updateData)) {
        echo "<p class='success-message'>Medlem opdateret succesfuldt!</p>";
        // Omdiriger til hovedmenu eller medlemsliste
        header("Location: members.php");
        exit();
    } else {
        echo "<p class='error-message'>Kunne ikke opdatere medlemmet.</p>";
    }
}

$inputList = [
    ["firstName", "Fornavn", "text"],
    ["lastName", "Efternavn", "text"],
    ["address1", "Adresse", "text"],
    ["address2", "2. Adresse", "text"],
    ["postalCode", "Post nr.", "number"],
    ["city", "By", "text"],
    ["email", "Mail", "email"],
    ["phone", "Telefonnummer", "tel"]
];
?>
<div class="container container-lg box-bg-gradient">
  <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
  <h1>Rediger medlem</h1>
  <main class="box-content-padding box-center flex">
    <form action="editUser.php?MemberID=<?php echo htmlspecialchars($_GET['MemberID']); ?>" method="post" id="medlem" class="container flex-direction-column">
      <input type="hidden" name="memberID" value="<?php echo htmlspecialchars($memberData['MemberID']); ?>">
      <?php foreach ($inputList as $item): ?>
        <div class="box-input-container">
          <label for="<?= $item[0] ?>"><?= $item[1] ?></label>
          <input 
            type="<?= $item[2] ?>" 
            name="<?= $item[0] ?>" 
            id="<?= $item[0] ?>" 
            placeholder="<?= $item[1] ?>" 
            value="<?= htmlspecialchars($memberData[$item[0]] ?? ''); ?>" 
            required
          >
        </div>
      <?php endforeach; ?>
      <div class="box-input-container box-center">
        <button class="btn-white-greenhover" type="submit">Opdater medlem</button>
      </div>
    </form>
  </main>
</div>

<?php
include("footer.php");
?>
