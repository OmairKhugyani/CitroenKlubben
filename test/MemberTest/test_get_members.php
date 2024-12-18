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

// Hent alle medlemmer fra databasen
$members = $member->getAllMembers();

// Kontroller, om der er medlemmer i databasen
if (!empty($members)) {
    echo "Medlemmer fundet:\n"; // Udskriv en succesmeddelelse

    // Loop gennem hver række i resultatet og udskriv detaljer om medlemmer
    foreach ($members as $m) {
        echo $m['LocalMemberID'] . " - " . $m['FirstName'] . " " . $m['LastName'] . "\n";
    }
} else {
    // Hvis der ikke findes medlemmer, udskriv en besked
    echo "Ingen medlemmer fundet.\n";
}
