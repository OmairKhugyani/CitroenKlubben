<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/VehicleRegister.php';

$vehicleRegister = new VehicleRegister($db);

// Test VehicleID
$vehicleID = 1; // Indsæt et gyldigt VehicleID, som allerede findes i databasen.

$updatedData = [
    'vehicleID' => $vehicleID, // ID på køretøjet, der skal opdateres
    'memberID' => 1,          // Sørg for, at denne MemberID findes
    'model' => 'Citroën C4',
    'chassisNumber' => 'VF7C3PNKF9J654321',
    'licensePlate' => 'XY98765',
    'color' => 'Blue',
    'specialFeatures' => 'Leather Seats, GPS',
    'firstRegistrationDate' => '2024-06-20'
];

echo "Updating vehicle with ID: {$vehicleID}...\n";

if ($vehicleRegister->updateVehicle($updatedData)) {
    echo "Vehicle updated successfully!\n";
    echo "Updated vehicle details:\n";
    $vehicle = $vehicleRegister->getVehicleById($vehicleID);
    echo "{$vehicle['VehicleID']} - Model: {$vehicle['Model']}, License Plate: {$vehicle['LicensePlate']}, MemberID: {$vehicle['MemberID']}\n";
} else {
    echo "Failed to update vehicle with ID: $vehicleID.\n";
}
?>
