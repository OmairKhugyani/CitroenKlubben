<?php
require("header.php");
require '../controller/MemberController.php';

if (isset($_SESSION["Loggedin"]) && $_SESSION["Loggedin"] === true) {
  header("location: mainMenu.php");
  exit;
}
$memberController = new MemberController($db);

?>
<div class="container box-bg-gradient">
  <h1>Log in</h1>
  <div class="box-content-padding ">
    <form method="post">

      <div class="box-input-container ">
        <label for="userid">Medlems nummer</label>
        <input type="text" name="userid" id="userid" placeholder="Medlems nummer" required>
      </div>

      <div class="box-input-container ">
        <label for="password">Kode ord</label>
        <input type="password" name="password" id="password" placeholder="Kode ord" required>
      </div>

      <div class="box-input-container ">
        <input type="submit" class="btn-login margin-x-auto">
      </div>

    </form>
  </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $memberController->UserLogInd($_POST['userid'], $_POST['password']);
  } catch (Exception $ex) {
    echo "<script>console.log({$ex})<script>";
  }
}

include("footer.php");
?>