<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/MemberRoles.php';

$memberRole = new MemberRoles($db);

// Test RoleID
$roleID = 1; // Replace with a valid RoleID

$updatedData = [
    'roleID' => $roleID,
    'memberID' => 2,      // Replace with a valid MemberID
    'role' => 'Chairman'  // Updated role
];

echo "Updating member role with ID: {$roleID}...\n";

if ($memberRole->updateMemberRole($updatedData)) {
    echo "Member role updated successfully!\n";
} else {
    echo "Failed to update member role with ID: $roleID.\n";
}
?>
