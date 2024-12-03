<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Responsibilities.php';

$responsibility = new Responsibilities($db);

// Test RoleID
$roleID = 1; // Replace with a valid RoleID

$updatedData = [
    'roleID' => $roleID,
    'memberID' => 2,      // Replace with a valid MemberID
    'role' => 'Chairman'  // Updated role
];

echo "Updating responsibility with ID: {$roleID}...\n";

if ($responsibility->updateResponsibility($updatedData)) {
    echo "Responsibility updated successfully!\n";
} else {
    echo "Failed to update responsibility with ID: $roleID.\n";
}
?>
