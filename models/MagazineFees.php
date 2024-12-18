<?php

class MagazineFees {
    private $db;

    // Attributes for the MagazineFees class
    public $magazineFeeID;
    public $paperCopy;
    public $electronicCopy;

    // Constructor to initialize the database
    public function __construct($db) {
        $this->db = $db;
    }

    // Retrieve all magazine fees
    public function getAllMagazineFees() {
        $sql = "SELECT * FROM MagazineFees";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update a magazine fee
    public function updateMagazineFee($data) {
        $sql = "UPDATE MagazineFees SET
            PaperCopy = :paperCopy,
            ElectronicCopy = :electronicCopy
            WHERE MagazineFeeID = :magazineFeeID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':paperCopy' => $data['paperCopy'],
            ':electronicCopy' => $data['electronicCopy'],
            ':magazineFeeID' => $data['magazineFeeID']
        ]);
    }
}
