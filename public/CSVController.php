<?php
require '../config.php';
require '../models/Club.php';
require '../models/Member.php';
require '../models/ClubRelation.php';

$club = new Club($db);
$member = new Member($db);
$clubRelation = new ClubRelation($db);

if ($_GET['action'] === 'exportClubs') {
    $selectedClub = $_GET['club'] ?? 'all';
    exportClubs($selectedClub, $club);
}

if ($_GET['action'] === 'exportMembersAndClubs') {
    $selectedClub = $_GET['club'] ?? 'all';
    exportMembersAndClubs($selectedClub, $club, $member, $clubRelation);
}

function exportClubs($clubID, $clubModel) {
    $clubs = ($clubID === 'all') ? $clubModel->getAllClubs() : [$clubModel->getClubById($clubID)];
    generateCSV($clubs, 'clubs_export.csv');
}

function exportMembersAndClubs($clubID, $clubModel, $memberModel, $clubRelationModel) {
    $db = $memberModel->getDbConnection(); // Brug den nye metode til at hente db-forbindelsen
    
    if ($clubID === 'all') {
        $sql = "SELECT Member.*, Club.ClubName 
                FROM Member 
                JOIN ClubRelation ON Member.MemberID = ClubRelation.MemberID
                JOIN Club ON ClubRelation.ClubID = Club.ClubID";
        $stmt = $db->query($sql);
    } else {
        $sql = "SELECT Member.*, Club.ClubName 
                FROM Member 
                JOIN ClubRelation ON Member.MemberID = ClubRelation.MemberID
                JOIN Club ON ClubRelation.ClubID = Club.ClubID
                WHERE Club.ClubID = :clubID";
        $stmt = $db->prepare($sql);
        $stmt->execute([':clubID' => $clubID]);
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    generateCSV($data, 'members_and_clubs_export.csv');
}

function generateCSV($data, $filename) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $filename);
    $output = fopen('php://output', 'w');
    if (!empty($data)) {
        fputcsv($output, array_keys($data[0])); // Headers
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
    }
    fclose($output);
    exit();
}
