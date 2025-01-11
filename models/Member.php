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
    public ?int $phone;
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
    public function getDbConnection() {
        return $this->db;
    }
    

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
            $query = "SELECT * FROM Member WHERE MemberID = :id";
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

    public function getMemberClassById($memberID): self
    {
        $sql = "SELECT * FROM Member WHERE MemberID = :memberID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':memberID' => $memberID]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->memberID = $data["MemberID"];
        $this->localMemberID = $data["LocalMemberID"];
        $this->firstName = $data["FirstName"];
        $this->lastName = $data["LastName"];
        $this->address1 = $data["Address1"];
        $this->address2 = $data["Address2"];
        $this->postalCode = $data["PostalCode"];
        $this->city = $data["City"];
        $this->phone = $data["Phone"];
        $this->email = $data["Email"];
        $this->joinDate = $data["JoinDate"];
        $this->directDebitAgreement = $data["DirectDebitAgreement"];
        $this->membershipPaidUntil = $data["MembershipPaidUntil"];
        $this->youthMembership = $data["YouthMembership"];
        $this->youthMembershipYear = $data["YouthMembershipYear"];
        $this->isApua = $data["Apua"];
        $this->isDistrictAdmin = $data["RegionAdmin"];
        $this->isAdmin = $data["Admin"];
        $this->allowRegion = $data["AllowRegion"];
        $this->allowAll = $data["AllowAll"];
        $this->passWord = $data["PassWord"];
        $this->passWordChanged = $data["PassWordChanged"];
        return $this;
    }

    // Retrieve a member by club, used for list
    public function getMemberByLocalClubID($LocalID)
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
            PassWordChanged = :passWordChanged
            WHERE MemberID = :memberID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function updateMemberByClass()
    {
        $sql = "UPDATE Member SET
            FirstName = {$this->firstName},
            LastName = {$this->lastName},
            Address1 = {$this->address1},
            Address2 = {$this->address2},
            PostalCode = {$this->postalCode},
            City = {$this->city},
            Phone = {$this->phone},
            Email = {$this->email},
            DirectDebitAgreement = {$this->directDebitAgreement},
            MembershipPaidUntil = {$this->membershipPaidUntil},
            YouthMembership = {$this->youthMembership},
            YouthMembershipYear = {$this->youthMembershipYear},
            Apua = {$this->isApua},
            RegionAdmin = {$this->isDistrictAdmin},
            Admin = {$this->isAdmin},
            AllowRegion = {$this->allowRegion},
            AllowAll = {$this->allowAll},
            PassWord = {$this->passWord},
            PassWordChanged = {$this->passWordChanged},
            WHERE MemberID = {$this->memberID}";

        print_r($sql);
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($this);
    }

    // Delete a member
    public function deleteMember($memberID)
    {
        $sql = "DELETE FROM Member WHERE MemberID = :memberID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':memberID' => $memberID]);
    }
}
