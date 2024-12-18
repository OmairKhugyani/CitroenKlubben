<?php

class VehicleRegister {
    private $db;

    // Attributes for the VehicleRegister class
    public $vehicleID;
    public $memberID;
    public $model;
    public $chassisNumber;
    public $licensePlate;
    public $color;
    public $specialFeatures;
    public $firstRegistrationDate;

    // Constructor to initialize the database
    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new vehicle entry
    public function createVehicle($data) {
        $sql = "INSERT INTO VehicleRegister (MemberID, Model, ChassisNumber, LicensePlate, Color, SpecialFeatures, FirstRegistrationDate)
        VALUES (:memberID, :model, :chassisNumber, :licensePlate, :color, :specialFeatures, :firstRegistrationDate)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Retrieve all vehicles
    public function getAllVehicles() {
        $sql = "SELECT * FROM VehicleRegister";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve a vehicle by ID
    public function getVehicleById($vehicleID) {
        $sql = "SELECT * FROM VehicleRegister WHERE VehicleID = :vehicleID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':vehicleID' => $vehicleID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a vehicle
    public function updateVehicle($data) {
        $sql = "UPDATE VehicleRegister SET
            MemberID = :memberID,
            Model = :model,
            ChassisNumber = :chassisNumber,
            LicensePlate = :licensePlate,
            Color = :color,
            SpecialFeatures = :specialFeatures,
            FirstRegistrationDate = :firstRegistrationDate
            WHERE VehicleID = :vehicleID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Delete a vehicle
    public function deleteVehicle($vehicleID) {
        $sql = "DELETE FROM VehicleRegister WHERE VehicleID = :vehicleID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':vehicleID' => $vehicleID]);
    }
}
