<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Club.php';

$club = new Club($db);

// Test ClubID
$clubID = 1; // Replace with a valid ClubID

echo "Deleting club with ID: {$clubID}...\n";

if ($club->deleteClub($clubID)) {
    echo "Club with ID {$clubID} deleted successfully!\n";
} else {
    echo "Failed to delete club with ID: {$clubID}.\n";
}
?>
