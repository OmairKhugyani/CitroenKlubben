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

// Data til opdatering
$data = [
    'memberID' => 1, // ID for medlemmet, der skal opdateres
    'firstName' => 'UpdatedName',
    'lastName' => 'UpdatedLastName',
    'address1' => 'Updated Address 1',
    'address2' => null,
    'postalCode' => '5678',
    'city' => 'UpdatedCity',
    'phone' => '87654321',
    'email' => 'updated@example.com',
    'joinDate' => date('Y-m-d'),
    'directDebitAgreement' => 0,
    'membershipPaidUntil' => '2026-12-31',
    'youthMembership' => 1,
    'youthMembershipYear' => 2026,
    'apua' => 1, // Opdateret nøgle
    'regionAdmin' => 0,
    'admin' => 0,
    'allowRegion' => 0,
    'allowAll' => 1
];


// Kald funktionen for at opdatere medlemmet
if ($member->updateMember($data)) {
    echo "Medlem opdateret succesfuldt!\n";
} else {
    echo "Fejl ved opdatering af medlem.\n";
}
?>
