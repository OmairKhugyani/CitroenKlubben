<?php
require 'config.php';
require 'classes/Member.php';

// Start sessionen for login-check
session_start();

// Kontroller, om brugeren er logget ind
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php'); // Omdiriger til login, hvis ikke logget ind
//     exit();
// }

// Instans af Member-klassen med databaseforbindelse
$member = new Member($db);

// Hent medlemsdata
$members = $member->getAllMembers();

?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Citroën Klubben</title>
</head>
<body>
    <h1>Velkommen til Citroën Klubben</h1>
    <h2>Medlemsoversigt</h2>

    <?php if (!empty($members)): ?>
        <ul>
            <?php foreach ($members as $member): ?>
                <li><?php echo htmlspecialchars($member['FirstName'] . ' ' . $member['LastName']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Ingen medlemmer fundet.</p>
    <?php endif; ?>

</body>
</html>
