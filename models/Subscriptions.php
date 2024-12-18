<?php

class Subscriptions {
    private $db;

    // Attributes for the Subscriptions class
    public $subscriptionID;
    public $memberID;
    public $printedPaper;
    public $mhs;
    public $newsletter;
    public $magazineFeeID;

    // Constructor to initialize the database
    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new subscription
    public function createSubscription($data) {
        $sql = "INSERT INTO Subscriptions (MemberID, PrintedPaper, MHS, Newsletter, MagazineFeeID)
        VALUES (:memberID, :printedPaper, :mhs, :newsletter, :magazineFeeID)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Retrieve all subscriptions
    public function getAllSubscriptions() {
        $sql = "SELECT * FROM Subscriptions";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve subscription by ID
    public function getSubscriptionById($subscriptionID) {
        $sql = "SELECT * FROM Subscriptions WHERE SubscriptionID = :subscriptionID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':subscriptionID' => $subscriptionID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a subscription
    public function updateSubscription($data) {
        $sql = "UPDATE Subscriptions SET
            MemberID = :memberID,
            PrintedPaper = :printedPaper,
            MHS = :mhs,
            Newsletter = :newsletter,
            MagazineFeeID = :magazineFeeID
            WHERE SubscriptionID = :subscriptionID";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Delete a subscription
    public function deleteSubscription($subscriptionID) {
        $sql = "DELETE FROM Subscriptions WHERE SubscriptionID = :subscriptionID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':subscriptionID' => $subscriptionID]);
    }
}
