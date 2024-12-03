<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Subscriptions.php';

$subscription = new Subscriptions($db);

$data = [
    'memberID' => 1,           // Ensure this MemberID exists
    'printedPaper' => 1,       // 1 = Subscribed, 0 = Not Subscribed
    'mhs' => 1,                // 1 = Subscribed, 0 = Not Subscribed
    'newsletter' => 1,         // 1 = Subscribed, 0 = Not Subscribed
    'magazineFeeID' => 1       // Ensure this MagazineFeeID exists
];

echo "Creating a new subscription...\n";
if ($subscription->createSubscription($data)) {
    echo "Subscription created successfully!\n";
} else {
    echo "Failed to create subscription.\n";
}
?>
