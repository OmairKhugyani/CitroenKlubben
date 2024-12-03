<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/MemberRoles.php';

$memberRole = new MemberRoles($db);

// Test RoleID
$roleID = 1; // Replace with a valid RoleID

echo "Deleting member role with ID: {$roleID}...\n";

if ($memberRole->deleteMemberRole($roleID)) {
    echo "Member role with ID {$roleID} deleted successfully!\n";
} else {
    echo "Failed to delete member role with ID: {$roleID}.\n";
}
?>
