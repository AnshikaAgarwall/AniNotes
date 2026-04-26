 <?php
include 'config.php';

$class_id = $_POST['class_id'];
$name = $_POST['subject'];

$db->exec("INSERT INTO subjects (class_id,name) VALUES ('$class_id','$name')");

header("Location: dashboard.php?class=".$class_id);
?> 