<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Newsletter.php';

$newsletter = new Newsletter($db);

// Test SubscriptionID and ClubID
$subscriptionID = 1; // Replace with a valid SubscriptionID
$clubID = 1;         // Replace with a valid ClubID

$updatedData = [
    'subscriptionID' => $subscriptionID,
    'clubID' => $clubID,
    'generalNews' => 0,      // Update value
    'clubNews' => 1          // Update value
];

echo "Updating newsletter subscription for SubscriptionID: {$subscriptionID} and ClubID: {$clubID}...\n";

if ($newsletter->updateNewsletter($updatedData)) {
    echo "Newsletter subscription updated successfully!\n";
} else {
    echo "Failed to update newsletter subscription for SubscriptionID: {$subscriptionID} and ClubID: {$clubID}.\n";
}
?>
