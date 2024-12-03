<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/MemberRoles.php';

$memberRole = new MemberRoles($db);

echo "Retrieving all member roles...\n";

$roles = $memberRole->getAllMemberRoles();

if (!empty($roles)) {
    echo "Member roles found:\n";
    foreach ($roles as $role) {
        echo "RoleID: {$role['RoleID']}, MemberID: {$role['MemberID']}, Role: {$role['Role']}\n";
    }
} else {
    echo "No member roles found.\n";
}
?>
