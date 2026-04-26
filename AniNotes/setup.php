<?php
$db = new SQLite3(__DIR__ . '/database.db');

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT UNIQUE,
    password TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS files (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    filename TEXT,
    filepath TEXT,
    semester TEXT,
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

echo "Database & Tables Created!";
?>