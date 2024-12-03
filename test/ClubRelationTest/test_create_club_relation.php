<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/ClubRelation.php';

$clubRelation = new ClubRelation($db);

$data = [
    'memberID' => 1, // Ensure this MemberID exists
    'clubID' => 1    // Ensure this ClubID exists
];

echo "Creating a new club relation...\n";
if ($clubRelation->createClubRelation($data)) {
    echo "Club relation created successfully!\n";
} else {
    echo "Failed to create club relation.\n";
}
?>
