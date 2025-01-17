<?php
// Aktivér fejlrapportering for at hjælpe med debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Indlæs databasekonfiguration og Member-klassen
require '../../config.php';
require '../../Models/MemberOO.php';

$member = new Member($db);

if (true) {
  $member->localMemberID = "TEST001";
  $member->firstName = "jake";
  $member->lastName = "nikle";
  $member->email = "jake@nikle";
  $member->passWord = "123";

  $member->createMember();
  $member->getMemberById($db->lastInsertId());
  print_r($member);



  // $member->updateMember();
  // print_r($member->getMemberByLocalMemberID($member->localMemberID));

  // $member->phone = 2393;
  // $member->allowAll = true;

  // $member->updateMember();
  // print_r($member->getMemberByLocalMemberID($member->localMemberID));
  // echo $member->allowAll == true ? 'true' : 'false';

  $member->deleteMember($member->memberID);
} else {
  $members = $member->getAllMembers();
  print_r($members);
}
