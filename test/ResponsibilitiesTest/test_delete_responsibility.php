<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Responsibilities.php';

$responsibility = new Responsibilities($db);

// Test RoleID
$roleID = 1; // Replace with a valid RoleID

echo "Deleting responsibility with ID: {$roleID}...\n";

if ($responsibility->deleteResponsibility($roleID)) {
    echo "Responsibility with ID {$roleID} deleted successfully!\n";
} else {
    echo "Failed to delete responsibility with ID: {$roleID}.\n";
}
?>
