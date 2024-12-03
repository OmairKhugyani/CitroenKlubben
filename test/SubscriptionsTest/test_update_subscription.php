<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Subscriptions.php';

$subscription = new Subscriptions($db);

// Test SubscriptionID
$subscriptionID = 1; // Replace with a valid SubscriptionID

$updatedData = [
    'subscriptionID' => $subscriptionID,
    'memberID' => 1,            // Ensure this MemberID exists
    'printedPaper' => 0,        // Update value
    'mhs' => 1,                 // Update value
    'newsletter' => 0           // Update value
];

echo "Updating subscription with ID: {$subscriptionID}...\n";

if ($subscription->updateSubscription($updatedData)) {
    echo "Subscription updated successfully!\n";
} else {
    echo "Failed to update subscription with ID: $subscriptionID.\n";
}
?>
