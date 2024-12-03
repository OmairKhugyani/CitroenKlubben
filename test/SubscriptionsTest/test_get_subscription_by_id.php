<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Subscriptions.php';

$subscription = new Subscriptions($db);

// Test SubscriptionID
$subscriptionID = 1; // Replace with a valid SubscriptionID

echo "Retrieving subscription with ID: $subscriptionID...\n";

$sub = $subscription->getSubscriptionById($subscriptionID);

if ($sub) {
    echo "Subscription found:\n";
    echo "SubscriptionID: {$sub['SubscriptionID']}, MemberID: {$sub['MemberID']}, PrintedPaper: {$sub['PrintedPaper']}, MHS: {$sub['MHS']}, Newsletter: {$sub['Newsletter']}\n";
} else {
    echo "No subscription found with ID: $subscriptionID.\n";
}
?>
