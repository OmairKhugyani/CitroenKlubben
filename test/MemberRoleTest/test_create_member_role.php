<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/MemberRoles.php';

$memberRole = new MemberRoles($db);

$data = [
    'memberID' => 1,      // Replace with a valid MemberID
    'role' => 'Treasurer' // Example role
];

echo "Creating a new member role...\n";
if ($memberRole->createMemberRole($data)) {
    echo "Member role created successfully!\n";
} else {
    echo "Failed to create member role.\n";
}
?>
