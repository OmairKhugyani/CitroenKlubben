<?php
require("header.php");
require_once '../models/Member.php';
require_once '../config.php';

if (isset($_SESSION["Loggedin"]) && $_SESSION["Loggedin"] === true) {
  header("location: mainMenu.php");
  exit;
}

$DBResult = $userid = $password = "";
$userid_err = $password_err = $login_err = "";

$member = new Member($db);
?>
<div class="container box-bg-gradient">
  <h1>Log in</h1>
  <div class="box-content-padding ">
    <form method="post">
      <div class="box-input-container ">
        <label for="userid">Medlems nummer</label>
        <input type="text" name="userid" id="userid" placeholder="Medlems nummer" required>
      </div>
      <?php if ($userid_err != "") { ?>
        <div class="warning-box margin-x-auto">
          <p><?= $userid_err ?></p>
        </div>
      <?php } ?>
      <div class="box-input-container ">
        <label for="password">Kode ord</label>
        <input type="password" name="password" id="password" placeholder="Kode ord" required>
      </div>
      <?php if ($password_err != "") { ?>
        <div class="warning-box margin-x-auto">
          <p><?= $userid_err ?></p>
        </div>
      <?php } ?>
      <div class="box-input-container ">
        <input type="submit" class="btn-login margin-x-auto">
      </div>
      <?php if ($login_err != "") { ?>
        <div class="error-box margin-x-auto">
          <h5>Fejl</h5>
          <p><?= $userid_err ?></p>
        </div>
      <?php } ?>
      <a href="mainMenu.php">Main menu</a>
    </form>
  </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["userid"]))) {
    $userid_err = "mangler bruger ID";
    exit;
  } else {
    $userid = trim($_POST["userid"]);
  }

  if (empty(trim($_POST["password"]))) {
    $password_err = "mangler kode ord";
    exit;
  } else {
    $password = trim($_POST["password"]);
  }

  // if and try blocks to catch both Exception err and empty value err
  try {
    $DBResult = $member->getMemberByLocalClubID($userid);
  } catch (Exception $ex) {
    $login_err = "kunne ikke finde bruger id";
    exit;
  }
  if (empty($DBResult)) {
    $login_err = "kunne ikke finde bruger id";
    exit;
  }


  if (password_verify($password, $DBResult["PassWord"])) {
    // if password currect starts new session with user data
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["MenberID"] = $DBResult["MemberID"];
    $_SESSION["localID"] = $DBResult["LocalMemberID"];
    $_SESSION["useraName"] = $DBResult["FirstName"] . " " . $DBResult["LastName"];
    $_SESSION["regionAdmin"] = $DBResult["RegionAdmin"];
    $_SESSION["admin"] = $DBResult["Admin"];
    $_SESSION["MemberRole"] = $DBResult["Admin"] ? "Admin" : "Medlem";
    header("location: mainMenu.php");
    exit;
  } else {
    $password_err = "Koden ord er forkert";
  }
}

include("footer.php");
?>