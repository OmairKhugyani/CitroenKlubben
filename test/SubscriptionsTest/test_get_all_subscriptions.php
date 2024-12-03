<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Subscriptions.php';

$subscription = new Subscriptions($db);

echo "Retrieving all subscriptions...\n";

$subscriptions = $subscription->getAllSubscriptions();

if (!empty($subscriptions)) {
    echo "Subscriptions found:\n";
    foreach ($subscriptions as $sub) {
        echo "SubscriptionID: {$sub['SubscriptionID']}, MemberID: {$sub['MemberID']}, PrintedPaper: {$sub['PrintedPaper']}, MHS: {$sub['MHS']}, Newsletter: {$sub['Newsletter']}\n";
    }
} else {
    echo "No subscriptions found.\n";
}
?>
