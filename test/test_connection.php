<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config.php';

if ($db) {
    echo "Forbindelsen til databasen er etableret.\n";
}
?>
