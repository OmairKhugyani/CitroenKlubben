<?php

class Responsibilities
{
    private $db;

    // Attributes for the Responsibilities class
    public $roleID;
    public $role;

    // Constructor to initialize the database
    public function __construct($db)
    {
        $this->db = $db;
    }

    private function populateResponsibility($data)
    {
        $this->roleID = $data['RoleID'];
        $this->role = $data['Role'];
    }

    // Create a new responsibility
    public function createResponsibility($data)
    {
        $sql = "INSERT INTO Responsibilities (MemberID, Role)
        VALUES (:memberID, :role)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Retrieve all responsibilities
    public function getAllResponsibilities()
    {
        $sql = "SELECT * FROM Responsibilities";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
        $Responsibilities = [];

        foreach ($results as $result) {
            $temp = new self($this->db);
            $temp->populateResponsibility($result);
            $Responsibilities[] = $temp;
        }
        return $Responsibilities;
    }


    // Retrieve a responsibility by ID
    public function getResponsibilityById($roleID)
    {
        $sql = "SELECT * FROM Responsibilities WHERE RoleID = :roleID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':roleID', $roleID);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->populateResponsibility($result);
        return $this;
    }

    // Update a responsibility
    public function updateResponsibility($data)
    {
        $sql = "UPDATE Responsibilities SET
            MemberID = :memberID,
            Role = :role
            WHERE RoleID = :roleID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Delete a responsibility
    public function deleteResponsibility($roleID)
    {
        $sql = "DELETE FROM Responsibilities WHERE RoleID = :roleID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':roleID' => $roleID]);
    }
}
