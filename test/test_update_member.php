<?php
// Aktivér fejlrapportering for at hjælpe med debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Indlæs databasekonfiguration og Member-klassen
require '../config.php';
require '../classes/Member.php';

// Opret en ny instans af Member-klassen
$member = new Member($db);

// Data til opdatering
$data = [
    'memberID' => 1, // ID'et på det medlem, du vil opdatere
    'firstName' => 'Updated',
    'lastName' => 'Person',
    'address1' => 'Ny Testvej 1',
    'address2' => 'Lejlighed 2',
    'postalCode' => '5678',
    'city' => 'Ny By',
    'phone' => '87654321',
    'email' => 'updated@example.com',
    'enrollmentDate' => date('Y-m-d'),
    'agreement' => 1,
    'membershipPaidUntil' => '2026-12-31',
    'youthMembership' => 1,
    'isDistrictAdmin' => 1,
    'isAdmin' => 1,
    'hasLimitedRights' => 0,
    'hasFullRights' => 1
];


// Kald funktionen for at opdatere medlemmet
if ($member->updateMember($data)) {
    echo "Medlem opdateret succesfuldt!\n";
} else {
    echo "Fejl ved opdatering af medlem.\n";
}
?>
