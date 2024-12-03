<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/ClubRelation.php';

$clubRelation = new ClubRelation($db);

echo "Retrieving all club relations...\n";

$relations = $clubRelation->getAllClubRelations();

if (!empty($relations)) {
    echo "Club relations found:\n";
    foreach ($relations as $relation) {
        echo "MemberID: {$relation['MemberID']}, ClubID: {$relation['ClubID']}\n";
    }
} else {
    echo "No club relations found.\n";
}
?>
