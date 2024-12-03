<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Club.php';

$club = new Club($db);

// Test ClubID
$clubID = 1; // Replace with a valid ClubID

$updatedData = [
    'clubID' => $clubID,
    'clubName' => 'Updated Club Name',
    'membershipFee' => 600,
    'abbreviation' => 'UC'
];

echo "Updating club with ID: {$clubID}...\n";

if ($club->updateClub($updatedData)) {
    echo "Club updated successfully!\n";
} else {
    echo "Failed to update club with ID: $clubID.\n";
}
?>
