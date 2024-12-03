<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../config.php';
require '../../classes/VehicleRegister.php';

$vehicleRegister = new VehicleRegister($db);

// Test VehicleID
$vehicleID = 1; // Indsæt et gyldigt VehicleID, som allerede findes i databasen.

echo "Deleting vehicle with ID: {$vehicleID}...\n";

if ($vehicleRegister->deleteVehicle($vehicleID)) {
    echo "Vehicle with ID {$vehicleID} deleted successfully!\n";

    // Verify deletion
    $vehicle = $vehicleRegister->getVehicleById($vehicleID);
    if (!$vehicle) {
        echo "Verified: Vehicle with ID {$vehicleID} no longer exists.\n";
    } else {
        echo "Warning: Vehicle with ID {$vehicleID} still exists in the database.\n";
    }
} else {
    echo "Failed to delete vehicle with ID: {$vehicleID}.\n";
}
?>
