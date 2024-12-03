<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Club.php';

$club = new Club($db);

// Test ClubID
$clubID = 1; // Replace with a valid ClubID

echo "Retrieving club with ID: $clubID...\n";

$clubData = $club->getClubById($clubID);

if ($clubData) {
    echo "Club found:\n";
    echo "{$clubData['ClubID']} - {$clubData['ClubName']} (Fee: {$clubData['MembershipFee']}, Abbreviation: {$clubData['Abbreviation']})\n";
} else {
    echo "No club found with ID: $clubID.\n";
}
?>
