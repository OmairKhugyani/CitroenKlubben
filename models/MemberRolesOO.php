<?php

class MemberRoles
{
    private $db;

    // Attributes for the MemberRoles class
    public $roleID;
    public $memberID;
    public $role;

    // Constructor to initialize the database
    public function __construct($db)
    {
        $this->db = $db;
    }

    private function populateRole($data)
    {
        $this->roleID = $data['RoleID'];
        $this->memberID = $data['MemberID'];
        $this->role = $data['Role'];
    }

    // Create a new member role
    public function createMemberRole(int $memberID, int $roleID)
    {
        $sql = "INSERT INTO MemberRoles (MemberID, RoleID)
        VALUES (:memberID, :roleID)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':memberID', $memberID, PDO::PARAM_INT);
        $stmt->bindParam(':roleID', $roleID, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Retrieve all member roles
    public function getAllMemberRoles()
    {
        $sql = "SELECT * FROM MemberRoles";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $roles = [];

        foreach ($results as $result) {
            $role = new self($this->db);
            $role->populateRole($result);
            $roles[] = $role;
        }
        return $roles;
    }

    // Retrieve a member role by ID
    public function getMemberRoleById($roleID)
    {
        $sql = "SELECT * FROM MemberRoles WHERE RoleID = :roleID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':roleID', $roleID, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->populateRole($result);
            return $this;
        } else {
            return null;
        }
    }

    // Retrieve a roleID by memberID
    public function getMemberRoleByMemberID($memberID)
    {
        $sql = "SELECT * FROM MemberRoles WHERE MemberID = :memberID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':memberID', $memberID, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->populateRole($result);
            return $this;
        } else {
            return null;
        }
    }

    // Update a member role
    public function updateMemberRole($data)
    {
        $sql = "UPDATE MemberRoles SET
            MemberID = :memberID,
            Role = :role
            WHERE RoleID = :roleID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':memberID' => $data['memberID'],
            ':role' => $data['role'],
            ':roleID' => $data['roleID']
        ]);
    }

    // Delete a member role
    public function deleteMemberRole($roleID)
    {
        $sql = "DELETE FROM MemberRoles WHERE RoleID = :roleID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':roleID' => $roleID]);
    }
}
