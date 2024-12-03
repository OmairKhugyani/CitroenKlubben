<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/MemberRoles.php';

$memberRole = new MemberRoles($db);

// Test RoleID
$roleID = 1; // Replace with a valid RoleID

echo "Retrieving member role with ID: $roleID...\n";

$roleData = $memberRole->getMemberRoleById($roleID);

if ($roleData) {
    echo "Member role found:\n";
    echo "RoleID: {$roleData['RoleID']}, MemberID: {$roleData['MemberID']}, Role: {$roleData['Role']}\n";
} else {
    echo "No member role found with ID: $roleID.\n";
}
?>
