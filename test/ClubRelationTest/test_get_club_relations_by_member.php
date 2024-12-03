<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/ClubRelation.php';

$clubRelation = new ClubRelation($db);

// Test MemberID
$memberID = 1; // Replace with a valid MemberID

echo "Retrieving club relations for MemberID: $memberID...\n";

$relations = $clubRelation->getClubRelationsByMemberID($memberID);

if (!empty($relations)) {
    echo "Club relations found for MemberID: $memberID\n";
    foreach ($relations as $relation) {
        echo "ClubID: {$relation['ClubID']}\n";
    }
} else {
    echo "No club relations found for MemberID: $memberID.\n";
}
?>
