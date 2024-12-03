<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Responsibilities.php';

$responsibility = new Responsibilities($db);

echo "Retrieving all responsibilities...\n";

$responsibilities = $responsibility->getAllResponsibilities();

if (!empty($responsibilities)) {
    echo "Responsibilities found:\n";
    foreach ($responsibilities as $resp) {
        echo "RoleID: {$resp['RoleID']}, MemberID: {$resp['MemberID']}, Role: {$resp['Role']}\n";
    }
} else {
    echo "No responsibilities found.\n";
}
?>
