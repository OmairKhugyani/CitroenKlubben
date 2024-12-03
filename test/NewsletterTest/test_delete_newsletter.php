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

echo "Deleting newsletter subscription for SubscriptionID: {$subscriptionID} and ClubID: {$clubID}...\n";

if ($newsletter->deleteNewsletter($subscriptionID, $clubID)) {
    echo "Newsletter subscription for SubscriptionID: {$subscriptionID} and ClubID: {$clubID} deleted successfully!\n";

    // Verify deletion
    $news = $newsletter->getNewsletterByIds($subscriptionID, $clubID);
    if (!$news) {
        echo "Verified: Newsletter subscription no longer exists.\n";
    } else {
        echo "Warning: Newsletter subscription still exists in the database.\n";
    }
} else {
    echo "Failed to delete newsletter subscription for SubscriptionID: {$subscriptionID} and ClubID: {$clubID}.\n";
}
?>
