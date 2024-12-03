<?php

class Club {
    private $db;

    // Attributes for the Club class
    public $clubID;
    public $clubName;
    public $membershipFee;
    public $abbreviation;

    // Constructor to initialize the database
    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new club
    public function createClub($data) {
        $sql = "INSERT INTO Club (ClubName, MembershipFee, Abbreviation)
        VALUES (:clubName, :membershipFee, :abbreviation)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Retrieve all clubs
    public function getAllClubs() {
        $sql = "SELECT * FROM Club";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve a club by ID
    public function getClubById($clubID) {
        $sql = "SELECT * FROM Club WHERE ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':clubID' => $clubID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a club
    public function updateClub($data) {
        $sql = "UPDATE Club SET
            ClubName = :clubName,
            MembershipFee = :membershipFee,
            Abbreviation = :abbreviation
            WHERE ClubID = :clubID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Delete a club
    public function deleteClub($clubID) {
        $sql = "DELETE FROM Club WHERE ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':clubID' => $clubID]);
    }
}
