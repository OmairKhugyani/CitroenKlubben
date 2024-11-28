<?php

class Member {
    private $db;

    // Attributter for klassen Member
    public $memberID;
    public $localMemberID;
    public $firstName;
    public $lastName;
    public $address1;
    public $address2;
    public $postalCode;
    public $city;
    public $phone;
    public $email;
    public $enrollmentDate;
    public $agreement;
    public $membershipPaidUntil;
    public $youthMembership;
    public $cutOffYearForYouthMembership;
    public $isAqua;
    public $isDistrictAdmin;
    public $isAdmin;
    public $hasLimitedRights;
    public $hasFullRights;

    // Constructor til initialisering af databasen
    public function __construct($db) {
        $this->db = $db;
    }

    // Opret et nyt medlem
    public function createMember($data) {
        $sql = "INSERT INTO Medlem (LokalMedlemsID, Fornavn, Efternavn, Adresse1, Adresse2, Postnummer, By, Telefon, Email, Indmeldelsesdato, BS_Aftale, KontingentBetaltTil, Ungdomskontingent, Kredadmin, Admin, TilladKreds, TilladAlle)
        VALUES (:LokalMedlemsID, :firstName, :lastName, :address1, :address2, :postalCode, :city, :phone, :email, :enrollmentDate, :agreement, :membershipPaidUntil, :youthMembership, :isDistrictAdmin, :isAdmin, :hasLimitedRights, :hasFullRights)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Hent alle medlemmer
    public function getAllMembers() {
        $sql = "SELECT * FROM Medlem";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hent et medlem baseret på ID
    public function getMemberById($memberID) {
        $sql = "SELECT * FROM Medlem WHERE MedlemID = :memberID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':memberID' => $memberID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Opdater et medlem
    public function updateMember($data) {
        $sql = "UPDATE Medlem SET
            Fornavn = :firstName,
            Efternavn = :lastName,
            Adresse1 = :address1,
            Adresse2 = :address2,
            Postnummer = :postalCode,
            By = :city,
            Telefon = :phone,
            Email = :email,
            Indmeldelsesdato = :enrollmentDate,
            BS_Aftale = :agreement,
            KontingentBetaltTil = :membershipPaidUntil,
            Ungdomskontingent = :youthMembership,
            Kredadmin = :isDistrictAdmin,
            Admin = :isAdmin,
            TilladKreds = :hasLimitedRights,
            TilladAlle = :hasFullRights
            WHERE MedlemID = :memberID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Slet et medlem
    public function deleteMember($memberID) {
        $sql = "DELETE FROM Medlem WHERE MedlemID = :memberID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':memberID' => $memberID]);
    }
}
