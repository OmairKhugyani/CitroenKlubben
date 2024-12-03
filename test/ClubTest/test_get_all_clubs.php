<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Club.php';

$club = new Club($db);

echo "Retrieving all clubs...\n";

$clubs = $club->getAllClubs();

if (!empty($clubs)) {
    echo "Clubs found:\n";
    foreach ($clubs as $club) {
        echo "{$club['ClubID']} - {$club['ClubName']} (Fee: {$club['MembershipFee']}, Abbreviation: {$club['Abbreviation']})\n";
    }
} else {
    echo "No clubs found.\n";
}
?>
