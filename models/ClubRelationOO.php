<?php

class ClubRelation
{
    private $db;

    // Attributes for the ClubRelation class
    public $memberID;
    public $clubID;

    // Constructor to initialize the database
    public function __construct($db)
    {
        $this->db = $db;
    }

    private function populateClubRelation($data)
    {
        $this->memberID = $data['MemberID'];
        $this->clubID = $data['ClubID'];
    }

    // Create a new club relation
    public function createClubRelation(int $memberID, int $clubID)
    {
        $sql = "INSERT INTO ClubRelation (MemberID, ClubID)
        VALUES (:memberID, :clubID)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':memberID', $memberID, PDO::PARAM_INT);
        $stmt->bindParam(':clubID', $clubID, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Retrieve all club relations
    public function getAllClubRelations()
    {
        $sql = "SELECT * FROM ClubRelation";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve club relations by MemberID
    public function getClubRelationsByMemberID($memberID)
    {
        $sql = "SELECT * FROM ClubRelation WHERE MemberID = :memberID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':memberID' => $memberID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve club relations by MemberID
    public function getClubRelationsByClub($clubID)
    {
        $sql = "SELECT * FROM ClubRelation WHERE ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':clubID' => $clubID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete a club relation
    public function deleteClubRelation($data)
    {
        $sql = "DELETE FROM ClubRelation WHERE MemberID = :memberID AND ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
