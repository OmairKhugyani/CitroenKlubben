<?php
session_start();
include("header.php");

require_once("./config.php");

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
      <a href="mainMenu.php">main menu</a>
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