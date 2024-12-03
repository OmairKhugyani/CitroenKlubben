<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/VehicleRegister.php';

$vehicleRegister = new VehicleRegister($db);

echo "Retrieving all vehicles...\n";

$vehicles = $vehicleRegister->getAllVehicles();

if (!empty($vehicles)) {
    echo "Vehicles found:\n";
    foreach ($vehicles as $vehicle) {
        echo "{$vehicle['VehicleID']} - Model: {$vehicle['Model']}, License Plate: {$vehicle['LicensePlate']}, MemberID: {$vehicle['MemberID']}\n";
    }
} else {
    echo "No vehicles found.\n";
}
?>
