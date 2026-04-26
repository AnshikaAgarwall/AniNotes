<?php
include 'config.php';

$id = $_POST['id'];

// Get file path
$result = $db->query("SELECT * FROM files WHERE id='$id'");
$file = $result->fetchArray();

if($file){
    unlink($file['filepath']); // delete file
    $db->exec("DELETE FROM files WHERE id='$id'");
}

header("Location: dashboard.php");
?>