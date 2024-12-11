<?php
try {
    $db = new PDO('sqlite:' . __DIR__ . '/db/CitroenKlubben.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Fejl ved forbindelse til databasen: " . $e->getMessage());
}
