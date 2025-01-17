<?php
// Aktivér fejlrapportering for at hjælpe med debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Indlæs databasekonfiguration og Member-klassen
require '../../config.php';
require '../../Models/Member.php';

// Opret en ny instans af Member-klassen
$member = new Member($db);

// Data til opdatering
$data = [
    'memberID' => "234", // ID for medlemmet, der skal opdateres
    'firstName' => 'nyt',
    'lastName' => 'dfg',
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
    'allowAll' => 1,
    'passWord' => '123',
    'passWordChanged' => 0,
];


//Kald funktionen for at opdatere medlemmet
// if ($member->updateMember($data)) {
//     echo "Medlem opdateret succesfuldt!\n";
// } else {
//     echo "Fejl ved opdatering af medlem.\n";
//}


/// etst for opbejct bassed Update fundction
$member = $member->getMemberClassById(38);
print_r($member);

$member->firstName = "erik";
$member->lastName = "bendt";
$member->address1 = "hyhavn";

$member->updateMemberByClass();

print_r($member = $member->getMemberClassById(38));
// print_r($test->updateMemberByClass());
