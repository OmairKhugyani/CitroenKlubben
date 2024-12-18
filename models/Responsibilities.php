<?php

class Responsibilities {
    private $db;

    // Attributes for the Responsibilities class
    public $roleID;
    public $memberID;
    public $role;

    // Constructor to initialize the database
    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new responsibility
    public function createResponsibility($data) {
        $sql = "INSERT INTO Responsibilities (MemberID, Role)
        VALUES (:memberID, :role)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Retrieve all responsibilities
    public function getAllResponsibilities() {
        $sql = "SELECT * FROM Responsibilities";
        $stmt = $this->db->query($sql);
    
        // Returnér altid en tom array, hvis der ikke er data
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }
    

    // Retrieve a responsibility by ID
    public function getResponsibilityById($roleID) {
        $sql = "SELECT * FROM Responsibilities WHERE RoleID = :roleID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':roleID' => $roleID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a responsibility
    public function updateResponsibility($data) {
        $sql = "UPDATE Responsibilities SET
            MemberID = :memberID,
            Role = :role
            WHERE RoleID = :roleID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Delete a responsibility
    public function deleteResponsibility($roleID) {
        $sql = "DELETE FROM Responsibilities WHERE RoleID = :roleID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':roleID' => $roleID]);
    }
}
