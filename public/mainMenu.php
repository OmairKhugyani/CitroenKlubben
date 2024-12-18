<?php
include("header.php");
?>
<div class="container container-lg box-bg-gradient">
  <a class="btn-small" href="index.php"><svg class="svg-door"></svg>Log af</a>
  <h1>Hovedmenu</h1>
  <div class="infobar-container">
    <div>
      <h6>Bruger</h6>
      <h3>MID0234</h3>
    </div>
    <div>
      <h6>Rettigheder</h6>
      <h3>Klubadmin</h3>
    </div>
  </div>
  <main class="box-content-padding">

    <div class="box-center">
      <h3 class="margin-bottom-0">Se medlemmer</h3>
    </div>
    <div class="container_space-around margin-bottom-1">
      <a class="link-remove btn" href="klubList.php"><svg class="svg-user"></svg>Egen klub</a>
      <a class="link-remove btn" href="klubList.php"><svg class="svg-user-more"></svg>Alle klubber</a>
    </div>

    <div class="box-center">
      <h3 class="margin-bottom-0">Medlemshåndtering</h3>
    </div>
    <div class="container_space-around margin-bottom-1">
    <a class="link-remove btn btn-white-greenhover" href="createUser.php"><svg class="svg-user-add"></svg>Tilføj medlem</a>
    <a class="link-remove btn btn-white-bluehover" href="editUser.php"><svg class="svg-user-edit"></svg>Rediger medlem</a>
    <a class="link-remove btn btn-white-redhover" href="deleteUser.php"><svg class="svg-user-remove"></svg>Fjern medlem</a>
</div>


    <div class="box-center">
      <h3 class="margin-bottom-0">Data udtræk</h3>
    </div>
    <div class="container_space-around margin-bottom-1">
      <a class="link-remove btn"><svg class="svg-doc"></svg>Udtræk klub data</a>
    </div>
  </main>
</div>
<?php
include("footer.php");
?>