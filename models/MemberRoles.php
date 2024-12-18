<?php

class MemberRoles {
    private $db;

    // Attributes for the MemberRoles class
    public $roleID;
    public $memberID;
    public $role;

    // Constructor to initialize the database
    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new member role
    public function createMemberRole($data) {
        $sql = "INSERT INTO MemberRoles (MemberID, Role)
        VALUES (:memberID, :role)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Retrieve all member roles
    public function getAllMemberRoles() {
        $sql = "SELECT * FROM MemberRoles";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve a member role by ID
    public function getMemberRoleById($roleID) {
        $sql = "SELECT * FROM MemberRoles WHERE RoleID = :roleID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':roleID' => $roleID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a member role
    public function updateMemberRole($data) {
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
    public function deleteMemberRole($roleID) {
        $sql = "DELETE FROM MemberRoles WHERE RoleID = :roleID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':roleID' => $roleID]);
    }
}
