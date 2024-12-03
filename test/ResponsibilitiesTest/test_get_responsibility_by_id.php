<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Responsibilities.php';

$responsibility = new Responsibilities($db);

// Test RoleID
$roleID = 1; // Replace with a valid RoleID

echo "Retrieving responsibility with ID: $roleID...\n";

$responsibilityData = $responsibility->getResponsibilityById($roleID);

if ($responsibilityData) {
    echo "Responsibility found:\n";
    echo "RoleID: {$responsibilityData['RoleID']}, MemberID: {$responsibilityData['MemberID']}, Role: {$responsibilityData['Role']}\n";
} else {
    echo "No responsibility found with ID: $roleID.\n";
}
?>
