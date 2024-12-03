<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Responsibilities.php';

$responsibility = new Responsibilities($db);

$data = [
    'memberID' => 1,      // Replace with a valid MemberID
    'role' => 'Secretary' // Example role
];

echo "Creating a new responsibility...\n";
if ($responsibility->createResponsibility($data)) {
    echo "Responsibility created successfully!\n";
} else {
    echo "Failed to create responsibility.\n";
}
?>
