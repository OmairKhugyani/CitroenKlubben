<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config.php';
require '../classes/Member.php';

$member = new Member($db);

$data = [
    'LokalMedlemsID' => 'MIJ003',
    'firstName' => 'Test',
    'lastName' => 'Person',
    'address1' => 'Testvej 1',
    'address2' => null,
    'postalCode' => '1234',
    'city' => 'Testby',
    'phone' => '12345678',
    'email' => 'test@example.com',
    'enrollmentDate' => date('Y-m-d'),
    'agreement' => 1,
    'membershipPaidUntil' => '2025-12-31',
    'youthMembership' => 0,
    'isDistrictAdmin' => 0,
    'isAdmin' => 0,
    'hasLimitedRights' => 0,
    'hasFullRights' => 1
];


if ($member->createMember($data)) {
    echo "Medlem oprettet succesfuldt!\n";
} else {
    echo "Fejl ved oprettelse af medlem.\n";
}
?>
