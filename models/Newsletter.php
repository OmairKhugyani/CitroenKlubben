<?php

class Newsletter {
    private $db;

    // Attributes for the Newsletter class
    public $newsletterID;
    public $subscriptionID;
    public $clubID;
    public $generalNews;
    public $clubNews;

    // Constructor to initialize the database
    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new newsletter subscription
    public function createNewsletter($data) {
        $sql = "INSERT INTO Newsletters (SubscriptionID, ClubID, GeneralNews, ClubNews)
        VALUES (:subscriptionID, :clubID, :generalNews, :clubNews)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // Retrieve all newsletter subscriptions
    public function getAllNewsletters() {
        $sql = "SELECT * FROM Newsletters";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve a newsletter subscription by ID
    public function getNewsletterByIds($subscriptionID, $clubID) {
        $sql = "SELECT * FROM Newsletters WHERE SubscriptionID = :subscriptionID AND ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':subscriptionID' => $subscriptionID,
            ':clubID' => $clubID
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    // Update a newsletter subscription
    public function updateNewsletter($data) {
        $sql = "UPDATE Newsletters SET
                GeneralNews = :generalNews,
                ClubNews = :clubNews
                WHERE SubscriptionID = :subscriptionID AND ClubID = :clubID";
    
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':generalNews' => $data['generalNews'],
            ':clubNews' => $data['clubNews'],
            ':subscriptionID' => $data['subscriptionID'],
            ':clubID' => $data['clubID']
        ]);
    }
    
    
  // Delete a newsletter subscription
    public function deleteNewsletter($subscriptionID, $clubID) {
        $sql = "DELETE FROM Newsletters WHERE SubscriptionID = :subscriptionID AND ClubID = :clubID";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':subscriptionID' => $subscriptionID,
            ':clubID' => $clubID
        ]);
    }
    
}
