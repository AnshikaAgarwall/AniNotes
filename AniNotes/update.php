<?php
include 'config.php';

$name = $_POST['classname'];
$user_id = $_SESSION['user_id'];

$db->exec("INSERT INTO classes (user_id,name) VALUES ('$user_id','$name')");

// get last inserted id
$id = $db->lastInsertRowID();

header("Location: dashboard.php?class=".$id);
?>