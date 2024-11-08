<?php
require_once 'classes/Member.php';

// Testfunktion til at teste getMemberInfo
function testGetMemberInfo() {
    // Opretter et Member-objekt
    $member = new Member(
        1, "MJ001", "Mikkel", "Jensen", "Vej 1", "Lejlighed 2",
        1234, "By", "12345678", "mikkel@example.com",
        "2023-01-01", true, "2024-01-01", true, 25,
        true, false, true, true, true
    );

    // Kalder getMemberInfo-metoden
    $result = $member->getMemberInfo();
    $expected = "Medlem: Mikkel Jensen, ID: 1";

    // Tjekker om resultatet matcher det forventede
    if ($result === $expected) {
        echo "Test bestået!";
    } else {
        echo "Test fejlede. Forventet: $expected, men fik: $result";
    }
}

// Kør testen
testGetMemberInfo();
