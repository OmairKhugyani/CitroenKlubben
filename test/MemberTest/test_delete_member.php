<?php
// Aktivér fejlrapportering for at hjælpe med debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Indlæs databasekonfiguration og Member-klassen
require '../../config.php';
require '../../models/Member.php';

// Opret en ny instans af Member-klassen
$member = new Member($db);

// ID'et på det medlem, der skal slettes
$memberID = 2; // Erstat med et faktisk ID, som findes i databasen

// Slet medlemmet
try {
    $member->deleteMember($memberID);
    echo "Medlem slettet succesfuldt!\n";
} catch (Exception $ex) {
    echo "Fejl ved sletning af medlem.\n";
    echo $ex;
}
