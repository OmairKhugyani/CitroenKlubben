<?php
// Opret forbindelse til SQLite-databasen
$db = new PDO('sqlite:db/CitroenKlubben.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>