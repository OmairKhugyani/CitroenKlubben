<?php
session_start();
include("header.php");
require '../models/Member.php';
require_once '../config.php';

if (isset($_SESSION["Loggedin"]) && $_SESSION["Loggedin"] === true) {
  header("location: mainMenu.php");
  exit;
}

$DBResult = $userid = $password = "";
$userid_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["userid"]))) {
    $userid_err = "mangler bruger ID";
  } else {
    $userid = trim($_POST["userid"]);
  }

  if (empty(trim($_POST["password"]))) {
    $password_err = "mangler kode ord";
  } else {
    $password = trim($_POST["password"]);
  }

  // if and try blocks to catch both Exception err and empty value err
  try {
    $DBResult = $members->getMemberByLocalMemberId($userid);
  } catch (Exception $ex) {
    $login_err = "kunne ikke finde bruger id";
    exit;
  }
  if (empty($DBResult)) {
    $login_err = "kunne ikke finde bruger id";
    exit;
  }

  // use in the furture
  //? if (password_verify($password, $DBResult["PassWord"]))
  if ($DBResult["PassWord"] == $password) {
    // if password currect starts new session with user data
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $DBResult["MemberID"];
    $_SESSION["LocalID"] = $DBResult["LocalMemberID"];
    $_SESSION["useraName"] = $DBResult["FirstName"] + " " + $DBResult["LastName"];
    $_SESSION["LocalAdmin"] = $DBResult["RegionAdmin"];
    $_SESSION["Admin"] = $DBResult["Admin"];
    //? $_SESSION["MemberRole"] = find merber role by id, if 1+ find roller  
  }
}

$member = new Member($db);
$members = $member->getAllMembers();
?>
<div class="container box-bg-gradient">
  <h1>Log in</h1>
  <div class="box-content-padding ">
    <form method="post">
      <div class="box-input-container ">
        <label for="username">Medlems nummer</label>
        <input type="text" name="username" placeholder="Medlems nummer" required>
      </div>
      <div class="box-input-container ">
        <label for="password">Kode ord</label>
        <input type="password" name="password" placeholder="Kode ord" required>
      </div>
      <div class="box-input-container ">
        <input type="submit" name="login" class="btn-login margin-x-auto">
      </div>
      <a href="mainMenu.php">Main menu</a>
    </form>
  </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["username"]) || empty($_POST["password"])) {
    return;
  }

  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

  if ($members && $password == "1234") {
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;

    header("Location: mainMenu.php");
  } else {
    echo "user do not exsist";
  }
}

include("footer.php");
?>