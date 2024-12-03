<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/MagazineFees.php';

$magazineFee = new MagazineFees($db);

echo "Retrieving all magazine fees...\n";

$fees = $magazineFee->getAllMagazineFees();

if (!empty($fees)) {
    echo "Magazine fees found:\n";
    foreach ($fees as $fee) {
        echo "MagazineFeeID: {$fee['MagazineFeeID']}, PaperCopy: {$fee['PaperCopy']}, ElectronicCopy: {$fee['ElectronicCopy']}\n";
    }
} else {
    echo "No magazine fees found.\n";
}
?>
