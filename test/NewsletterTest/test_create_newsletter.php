<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/Newsletter.php';

$newsletter = new Newsletter($db);

$data = [
    'subscriptionID' => 1,   // Ensure this SubscriptionID exists
    'clubID' => 1,           // Ensure this ClubID exists
    'generalNews' => 1,      // 1 = Subscribed, 0 = Not Subscribed
    'clubNews' => 1          // 1 = Subscribed, 0 = Not Subscribed
];

echo "Creating a new newsletter subscription...\n";
if ($newsletter->createNewsletter($data)) {
    echo "Newsletter subscription created successfully!\n";
} else {
    echo "Failed to create newsletter subscription.\n";
}
?>
