<?php
include 'config.php';

$subject_id = $_POST['subject_id'];
$file = $_FILES['file'];

$path = "uploads/" . $file['name'];
move_uploaded_file($file['tmp_name'], $path);

$db->exec("INSERT INTO files (subject_id, filename, filepath) 
VALUES ('$subject_id','".$file['name']."','$path')");

header("Location: " . $_SERVER['HTTP_REFERER']);
?>