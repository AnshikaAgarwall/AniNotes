<?php
include 'config.php';

echo "<h2>Users</h2>";
$res = $db->query("SELECT * FROM users");
while($row = $res->fetchArray()){
    echo $row['id']." | ".$row['name']." | ".$row['email']."<br>";
}

echo "<h2>Classes</h2>";
$res = $db->query("SELECT * FROM classes");
while($row = $res->fetchArray()){
    echo $row['id']." | ".$row['name']." | User: ".$row['user_id']."<br>";
}

echo "<h2>Subjects</h2>";
$res = $db->query("SELECT * FROM subjects");
while($row = $res->fetchArray()){
    echo $row['id']." | ".$row['name']." | Class: ".$row['class_id']."<br>";
}

echo "<h2>Files</h2>";
$res = $db->query("SELECT * FROM files");
while($row = $res->fetchArray()){
    echo $row['id']." | ".$row['filename']." | Subject: ".$row['subject_id']."<br>";
}
?>