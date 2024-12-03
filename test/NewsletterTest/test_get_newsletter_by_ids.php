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

echo "Retrieving newsletter subscription for SubscriptionID: $subscriptionID and ClubID: $clubID...\n";

$news = $newsletter->getNewsletterByIds($subscriptionID, $clubID);

if ($news) {
    echo "Newsletter subscription found:\n";
    echo "SubscriptionID: {$news['SubscriptionID']}, ClubID: {$news['ClubID']}, GeneralNews: {$news['GeneralNews']}, ClubNews: {$news['ClubNews']}\n";
} else {
    echo "No newsletter subscription found for SubscriptionID: $subscriptionID and ClubID: $clubID.\n";
}
?>
