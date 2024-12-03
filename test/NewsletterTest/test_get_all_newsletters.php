<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Newsletter.php';

$newsletter = new Newsletter($db);

echo "Retrieving all newsletter subscriptions...\n";

$newsletters = $newsletter->getAllNewsletters();

if (!empty($newsletters)) {
    echo "Newsletter subscriptions found:\n";
    foreach ($newsletters as $news) {
        echo "SubscriptionID: {$news['SubscriptionID']}, ClubID: {$news['ClubID']}, GeneralNews: {$news['GeneralNews']}, ClubNews: {$news['ClubNews']}\n";
    }
} else {
    echo "No newsletter subscriptions found.\n";
}
?>
