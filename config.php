<?php
// Opret forbindelse til SQLite-databasen
$db = new PDO('sqlite:db/CitroenKlubben.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Opret forbindelse til SQLite-databasen
$db = new PDO('sqlite:/Users/omairkhugyani/Desktop/DATAMATIKER/5.Semester/Hovedopgave/CitroenKlubben/db/CitroenKlubben.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

