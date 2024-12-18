<?php

class Member
{
    private $db;

    // Attributes for the Member class
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
    public $joinDate;
    public $directDebitAgreement;
    public $membershipPaidUntil;
    public $youthMembership;
    public $youthMembershipYear;
    public $isAqua;
    public $isDistrictAdmin;
    public $isAdmin;
    public $allowRegion;
    public $allowAll;

    // Constructor to initialize the database
    public function __construct($db)
    {
        $this->db = $db;
    }

    // // Create a new member
    // public function createMember($data)
    // {
    //     $sql = "INSERT INTO Member (LocalMemberID, FirstName, LastName, Address1, Address2, PostalCode, City, Phone, Email, DirectDebitAgreement, MembershipPaidUntil, YouthMembership, YouthMembershipYear, Apua, RegionAdmin, Admin, AllowRegion, AllowAll, PassWord, PassWordChanged)
    //     VALUES (:localMemberID, :firstName, :lastName, :address1, :address2, :postalCode, :city, :phone, :email, :directDebitAgreement, :membershipPaidUntil, :youthMembership, :youthMembershipYear, :apua, :regionAdmin, :admin, :allowRegion, :allowAll, :passWord, :passWordChanged)";

    //     $stmt = $this->db->prepare($sql);
    //     return $stmt->execute($data);
    // }

    // Create a new member
    public function createMember($data)
    {
        $sql = "INSERT INTO Member (LocalMemberID, FirstName, LastName, Address1, Address2, PostalCode, City, Phone, Email, DirectDebitAgreement, MembershipPaidUntil, YouthMembership, YouthMembershipYear, Apua, RegionAdmin, Admin, AllowRegion, AllowAll, PassWord, PassWordChanged)
            VALUES (:localMemberID, :firstName, :lastName, :address1, :address2, :postalCode, :city, :phone, :email, :directDebitAgreement, :membershipPaidUntil, :youthMembership, :youthMembershipYear, :apua, :regionAdmin, :admin, :allowRegion, :allowAll, :passWord, :passWordChanged)";

        $stmt = $this->db->prepare($sql);

        // Udfør indsættelsen
        if ($stmt->execute($data)) {
            // Hent ID'et for den nyligt indsatte række
            $newMemberId = $this->db->lastInsertId();

            // Hent og returner den nyoprettede bruger
            $query = "SELECT * FROM Member WHERE member1ID = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $newMemberId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false; // Hvis indsættelsen fejler
    }

    // Retrieve all members
    public function getAllMembers()
    {
        $sql = "SELECT * FROM Member";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve a member by ID
    public function getMemberById($memberID)
    {
        $sql = "SELECT * FROM Member WHERE MemberID = :memberID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':memberID' => $memberID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Retrieve a member by club, used for list
    public function getMembersByClub($LocalID)
    {
        $sql = "SELECT * FROM Member WHERE LocalMemberID = :LocalID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':LocalID' => $LocalID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a member
    public function updateMember($data)
    {
        $sql = "UPDATE Member SET
            FirstName = :firstName,
            LastName = :lastName,
            Address1 = :address1,
            Address2 = :address2,
            PostalCode = :postalCode,
            City = :city,
            Phone = :phone,
            Email = :email,
            JoinDate = :joinDate,
            DirectDebitAgreement = :directDebitAgreement,
            MembershipPaidUntil = :membershipPaidUntil,
            YouthMembership = :youthMembership,
            YouthMembershipYear = :youthMembershipYear,
            Apua = :apua,
            RegionAdmin = :regionAdmin,
            Admin = :admin,
            AllowRegion = :allowRegion,
            AllowAll = :allowAll,
            PassWord = :passWord,
            PassWordChanged = :passWordCHanged,
            WHERE MemberID = :memberID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Delete a member
    public function deleteMember($memberID)
    {
        $sql = "DELETE FROM Member WHERE MemberID = :memberID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':memberID' => $memberID]);
    }
}
