<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dbPath = __DIR__ . '/database.db';

if (!file_exists($dbPath)) {
    die("Database file not found at: " . $dbPath);
}

$db = new SQLite3($dbPath);
?>