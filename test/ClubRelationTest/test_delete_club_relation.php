<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/ClubRelation.php';

$clubRelation = new ClubRelation($db);

$data = [
    'memberID' => 1, // Replace with a valid MemberID
    'clubID' => 1    // Replace with a valid ClubID
];

echo "Deleting club relation...\n";

if ($clubRelation->deleteClubRelation($data)) {
    echo "Club relation deleted successfully!\n";
} else {
    echo "Failed to delete club relation.\n";
}
?>
