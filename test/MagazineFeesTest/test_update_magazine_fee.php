<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/MagazineFees.php';

$magazineFee = new MagazineFees($db);

// Test MagazineFeeID
$magazineFeeID = 1; // Replace with a valid MagazineFeeID

$updatedData = [
    'magazineFeeID' => $magazineFeeID,
    'paperCopy' => 60,         // Update value for paper copy
    'electronicCopy' => 40     // Update value for electronic copy
];

echo "Updating magazine fee with ID: {$magazineFeeID}...\n";

if ($magazineFee->updateMagazineFee($updatedData)) {
    echo "Magazine fee updated successfully!\n";
} else {
    echo "Failed to update magazine fee with ID: $magazineFeeID.\n";
}
?>
