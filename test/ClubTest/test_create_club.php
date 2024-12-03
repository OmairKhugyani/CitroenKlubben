<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Club.php';

$club = new Club($db);

$data = [
    'clubName' => 'Citroën Enthusiasts',
    'membershipFee' => 500,
    'abbreviation' => 'CE'
];

echo "Creating a new club...\n";
if ($club->createClub($data)) {
    echo "Club created successfully!\n";
} else {
    echo "Failed to create club.\n";
}
?>
