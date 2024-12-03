<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Subscriptions.php';

$subscription = new Subscriptions($db);

// Test SubscriptionID
$subscriptionID = 1; // Replace with a valid SubscriptionID

echo "Deleting subscription with ID: {$subscriptionID}...\n";

if ($subscription->deleteSubscription($subscriptionID)) {
    echo "Subscription with ID {$subscriptionID} deleted successfully!\n";
} else {
    echo "Failed to delete subscription with ID: {$subscriptionID}.\n";
}
?>
