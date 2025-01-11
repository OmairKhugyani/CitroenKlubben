<?php

// Lokale klubber

// 0 none
// 1 Nordvestjysk
// 2 Midtjylland
// 3 Sydvestjysk
// 4 Djursland
// 5 rekanten
// 6 Fyn
// 7 Citroënisterne – primært Nordsjælland og København
// 8 De Flyvende Citroner – øvrige Sjælland og Bornholm
// 9 Sydhavsøerne


// Modelrelaterede klubber

// 10 CX-club
// 11 HY-TEAM
// 12 MEHARI-gruppen
// 13 Berlingo /C1
// 14 Club Citroën C6 Danmark
// 15 Dansk Citroën SM Klub

class Club
{
    private $db;

    // Attributes for the Club class
    public $clubID;
    public string $clubName;
    public float $membershipFee;
    public string $abbreviation;

    // Constructor to initialize the database
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Create a new club
    public function createClub($data)
    {
        $sql = "INSERT INTO Club (ClubName, MembershipFee, Abbreviation)
        VALUES (:clubName, :membershipFee, :abbreviation)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Retrieve all clubs
    public function getAllClubs()
    {
        $sql = "SELECT * FROM Club";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve a club by ID
    public function getClubById($clubID)
    {
        $sql = "SELECT * FROM Club WHERE ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':clubID' => $clubID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a club
    public function updateClub($data)
    {
        $sql = "UPDATE Club SET
            ClubName = :clubName,
            MembershipFee = :membershipFee,
            Abbreviation = :abbreviation
            WHERE ClubID = :clubID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Delete a club
    public function deleteClub($clubID)
    {
        $sql = "DELETE FROM Club WHERE ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':clubID' => $clubID]);
    }


    // data getters
    public function getName(): string
    {
        return $this::$clubName;
    }

    // data getters
    public function getMembersByClubId($clubID)
    {
        $sql = "SELECT Member.MemberID, Member.FirstName, Member.LastName 
                FROM Member
                JOIN ClubRelation ON Member.MemberID = ClubRelation.MemberID
                WHERE ClubRelation.ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':clubID' => $clubID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMembersByClubId($clubID)
    {
        $sql = "SELECT *
                FROM Member
                JOIN ClubRelation ON Member.MemberID = ClubRelation.MemberID
                WHERE ClubRelation.ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':clubID' => $clubID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // data getters
    public function getAllMembersAndClubs()
    {
        $sql = "SELECT Member.MemberID, Member.FirstName, Member.LastName, Club.ClubID, Club.ClubName 
                FROM Member
                JOIN ClubRelation ON Member.MemberID = ClubRelation.MemberID
                JOIN Club ON ClubRelation.ClubID = Club.ClubID";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
