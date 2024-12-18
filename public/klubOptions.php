<?php
require '../config.php';
require '../classes/Club.php';

$club = new Club($db);
$clubs = $club->getAllClubs();

echo '<pre>';
print_r($clubs);
echo '</pre>';
?>

<option value="" selected disabled hidden>Vælg en klub</option>
<optgroup class="h5" label="Lokale klubber">
<optgroup label="Jylland">
  <option value="1">Nordvestjysk</option>
  <option value="2">Midtjylland</option>
  <option value="3">Sydvestjysk</option>
  <option value="4">Djursland</option>
  <option value="5">Trekanten</option>
  <option value="7">Citroënisterne <span class="text-small">- primært Nordsjælland og København</span></option>
</optgroup>
<optgroup label="Sjæland">
  <option value="8">De Flyvende Citroner <span class="text-small">- øvrige Sjælland og Bornholm</span></option>
  <option value="7">Citroënisterne <span class="text-small">- primært Nordsjælland og København</span></option>
</optgroup>
<optgroup label="Øvrige Danmark">
  <option value="6">Fyn</option>
  <option value="8">De Flyvende Citroner <span class="text-small">- øvrige Sjælland og Bornholm</span></option>
  <option value="9">Sydhavsøerne</option>
</optgroup>
</optgroup>
<optgroup class="h5" label="Model klubber">
  <option value="10">CX-club</option>
  <option value="11">HY-TEAM</option>
  <option value="12">MEHARI-gruppen</option>
  <option value="13">Berlingo /C1</option>
  <option value="14">Club Citroën C6 Danmark</option>
  <option value="15">Dansk Citroën SM Klub</option>
</optgroup>