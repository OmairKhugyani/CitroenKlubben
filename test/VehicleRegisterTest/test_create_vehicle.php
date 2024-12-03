<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the configuration and the class
require '../../config.php';
require '../../classes/VehicleRegister.php';

// Create a database connection
$vehicleRegister = new VehicleRegister($db);

// Test data for creating a vehicle
$testData = [
    'memberID' => 1, // Ensure this member exists
    'model' => 'Citroën C3',
    'chassisNumber' => 'VF7C3PNKF9J123456',
    'licensePlate' => 'AB12345',
    'color' => 'Red',
    'specialFeatures' => 'Sunroof, Alloy Wheels',
    'firstRegistrationDate' => '2023-01-15'
];

echo "Creating a new vehicle...\n";
if ($vehicleRegister->createVehicle($testData)) {
    echo "Vehicle created successfully!\n";
} else {
    echo "Failed to create vehicle.\n";
}
?>
