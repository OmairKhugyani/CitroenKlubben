<?php
// Aktivér fejlrapportering for at hjælpe med debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Indlæs databasekonfiguration og Member-klassen
require '../../config.php';
require '../../classes/Member.php';

// Opret en ny instans af Member-klassen
$member = new Member($db);

// Indstil det ID, du vil hente data for
$memberID = 1; // Erstat med et faktisk medlemID, som findes i din database

// Hent medlem baseret på ID
$result = $member->getMemberById($memberID);

// Kontroller, om medlemmet blev fundet
if ($result) {
    echo "Medlem fundet:\n";
    echo "ID: " . $result['MemberID'] . "\n";
    echo "MemberID: " . $result['MemberID'] . "\n";
    echo "Name: " . $result['FirstName'] . " " . $result['LastName'] . "\n";
    echo "Email: " . $result['Email'] . "\n";
} else {
    // Hvis medlemmet ikke findes, udskriv en besked
    echo "Ingen medlem fundet med ID: $memberID\n";
}
?>
