<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/VehicleRegister.php';

$vehicleRegister = new VehicleRegister($db);

// Test VehicleID
$vehicleID = 1; // Indsæt et gyldigt VehicleID, som allerede findes i databasen.

echo "Retrieving vehicle with ID: $vehicleID...\n";

$vehicle = $vehicleRegister->getVehicleById($vehicleID);

if ($vehicle) {
    echo "Vehicle found:\n";
    echo "{$vehicle['VehicleID']} - Model: {$vehicle['Model']}, License Plate: {$vehicle['LicensePlate']}, MemberID: {$vehicle['MemberID']}\n";
} else {
    echo "No vehicle found with ID: $vehicleID.\n";
}
?>
