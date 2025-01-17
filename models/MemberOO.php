<?php

class Member
{
    private $db;

    // Attributes for the Member class
    public int $memberID;
    public string $localMemberID;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $address1;
    public ?string $address2;
    public ?int $postalCode;
    public ?string $city;
    public ?string $phone;
    public ?string $email;
    public ?string $joinDate;
    public ?bool $directDebitAgreement;
    public ?string $membershipPaidUntil;
    public ?bool $youthMembership;
    public ?string $youthMembershipYear;
    public ?bool $isApua;
    public ?bool $isDistrictAdmin;
    public ?bool $isAdmin;
    public ?bool $allowRegion;
    public ?bool $allowAll;
    public ?string $passWord;
    public ?bool $passWordChanged;

    // Constructor to initialize the database
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Get the database connection
    public function getDbConnection()
    {
        return $this->db;
    }
    // Helper function to populate the Member object
    private function populateMember($data)
    {
        $this->memberID = $data['MemberID'];
        $this->localMemberID = $data['LocalMemberID'];
        $this->firstName = $data['FirstName'];
        $this->lastName = $data['LastName'];
        $this->address1 = $data['Address1'];
        $this->address2 = $data['Address2'];
        $this->postalCode = $data['PostalCode'];
        $this->city = $data['City'];
        $this->phone = $data['Phone'];
        $this->email = $data['Email'];
        $this->joinDate = $data['JoinDate'];
        $this->directDebitAgreement = $data['DirectDebitAgreement'];
        $this->membershipPaidUntil = $data['MembershipPaidUntil'];
        $this->youthMembership = $data['YouthMembership'];
        $this->youthMembershipYear = $data['YouthMembershipYear'];
        $this->isApua = $data['Apua'];
        $this->isDistrictAdmin = $data['RegionAdmin'];
        $this->isAdmin = $data['Admin'];
        $this->allowRegion = $data['AllowRegion'];
        $this->allowAll = $data['AllowAll'];
        $this->passWord = $data['PassWord'];
        $this->passWordChanged = $data['PassWordChanged'];
    }

    public function createMember()
    {
        $sql = "INSERT INTO Member (LocalMemberID, FirstName, LastName, Address1, Address2, PostalCode, City, Phone, Email, JoinDate, DirectDebitAgreement, MembershipPaidUntil, YouthMembership, YouthMembershipYear, Apua, RegionAdmin, Admin, AllowRegion, AllowAll, PassWord, PassWordChanged)
            VALUES (:localMemberID, :firstName, :lastName, :address1, :address2, :postalCode, :city, :phone, :email, :joinDate, :directDebitAgreement, :membershipPaidUntil, :youthMembership, :youthMembershipYear, :isApua, :isDistrictAdmin, :isAdmin, :allowRegion, :allowAll, :passWord, :passWordChanged)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':localMemberID', $this->localMemberID);
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':address1', $this->address1);
        $stmt->bindParam(':address2', $this->address2);
        $stmt->bindParam(':postalCode', $this->postalCode, PDO::PARAM_INT);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':joinDate', $this->joinDate);
        $stmt->bindParam(':directDebitAgreement', $this->directDebitAgreement, PDO::PARAM_BOOL);
        $stmt->bindParam(':membershipPaidUntil', $this->membershipPaidUntil);
        $stmt->bindParam(':youthMembership', $this->youthMembership, PDO::PARAM_BOOL);
        $stmt->bindParam(':youthMembershipYear', $this->youthMembershipYear);
        $stmt->bindParam(':isApua', $this->isApua, PDO::PARAM_BOOL);
        $stmt->bindParam(':isDistrictAdmin', $this->isDistrictAdmin, PDO::PARAM_BOOL);
        $stmt->bindParam(':isAdmin', $this->isAdmin, PDO::PARAM_BOOL);
        $stmt->bindParam(':allowRegion', $this->allowRegion, PDO::PARAM_BOOL);
        $stmt->bindParam(':allowAll', $this->allowAll, PDO::PARAM_BOOL);
        $stmt->bindParam(':passWord', password_hash($this->passWord, PASSWORD_DEFAULT));
        $stmt->bindParam(':passWordChanged', $this->passWordChanged, PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    public function getMemberById(int $memberID)
    {
        $sql = "SELECT * FROM Member WHERE MemberID = :memberID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':memberID', $memberID, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->populateMember($result);
            return $this;
        } else {
            return null;
        }
    }

    public function getAllMembers()
    {
        $sql = "SELECT * FROM Member";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $members = [];

        foreach ($results as $result) {
            $member = new self($this->db);
            $member->populateMember($result);
            $members[] = $member;
        }
        return $members;
    }


    public function getMemberByLocalMemberID($localMemberID)
    {
        $sql = "SELECT * FROM Member WHERE LocalMemberID = :localMemberID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':localMemberID', $localMemberID);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->populateMember($result);
            return $this;
        } else {
            return null;
        }
    }

    public function deleteMember($memberID)
    {
        $sql = "DELETE FROM Member WHERE MemberID = :memberID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':memberID', $memberID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateMember()
    {
        $sql = "UPDATE Member SET
            LocalMemberID = :localMemberID,
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
            Apua = :isApua,
            RegionAdmin = :isDistrictAdmin,
            Admin = :isAdmin,
            AllowRegion = :allowRegion,
            AllowAll = :allowAll,
            PassWord = :passWord,
            PassWordChanged = :passWordChanged
            WHERE MemberID = :memberID";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':memberID', $this->memberID, PDO::PARAM_INT);
        $stmt->bindParam(':localMemberID', $this->localMemberID);
        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':address1', $this->address1);
        $stmt->bindParam(':address2', $this->address2);
        $stmt->bindParam(':postalCode', $this->postalCode, PDO::PARAM_INT);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':joinDate', $this->joinDate);
        $stmt->bindParam(':directDebitAgreement', $this->directDebitAgreement, PDO::PARAM_BOOL);
        $stmt->bindParam(':membershipPaidUntil', $this->membershipPaidUntil);
        $stmt->bindParam(':youthMembership', $this->youthMembership, PDO::PARAM_BOOL);
        $stmt->bindParam(':youthMembershipYear', $this->youthMembershipYear);
        $stmt->bindParam(':isApua', $this->isApua, PDO::PARAM_BOOL);
        $stmt->bindParam(':isDistrictAdmin', $this->isDistrictAdmin, PDO::PARAM_BOOL);
        $stmt->bindParam(':isAdmin', $this->isAdmin, PDO::PARAM_BOOL);
        $stmt->bindParam(':allowRegion', $this->allowRegion, PDO::PARAM_BOOL);
        $stmt->bindParam(':allowAll', $this->allowAll, PDO::PARAM_BOOL);
        $stmt->bindParam(':passWord', $this->passWord);
        $stmt->bindParam(':passWordChanged', $this->passWordChanged, PDO::PARAM_BOOL);

        return $stmt->execute();
    }
}
