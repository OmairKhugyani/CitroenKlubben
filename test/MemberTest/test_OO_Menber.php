<?php
// Aktivér fejlrapportering for at hjælpe med debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Indlæs databasekonfiguration og Member-klassen
require '../../config.php';
require '../../Models/MemberOO.php';


$member = new Member($db);

$member->localMemberID = "TEST001";
$member->firstName = "jake";
$member->lastName = "nikle";
$member->email = "jake@nikle";
$member->passWord = "123";

$member->createMember();
print_r($member->getMemberById($db->lastInsertId()));

$member->address1 = "jake";
$member->city = "mikka";
$member->phone = "123456";

// $member->getAllMembers();

$member->updateMember();
print_r($member->getMemberByLocalMemberID($member->localMemberID));

$member->deleteMember($member->memberID);
