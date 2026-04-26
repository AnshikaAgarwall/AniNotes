<?php 
include 'config.php';

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get selected class
$class_id = $_GET['class'] ?? null;

// Auto-select first class
if(!$class_id){
    $first = $db->query("SELECT id FROM classes WHERE user_id='$user_id' LIMIT 1")->fetchArray();
    if($first){
        $class_id = $first['id'];
    }
}
?>

<link rel="stylesheet" href="style.css">

<!-- Sidebar -->
<div class="sidebar">

    <div class="class-list">
        <?php
        $classes = $db->query("SELECT * FROM classes WHERE user_id='$user_id'");
        while($c = $classes->fetchArray()){
            $active = ($class_id == $c['id']) ? "style='background:lavender;color:black;'" : "";
            echo "<a href='?class={$c['id']}' $active>{$c['name']}</a>";

        }
        ?>
    </div>

    <!-- Add Class -->
    <div class="add-class-box">
        <form method="POST" action="add_class.php">
            <input type="text" name="classname" placeholder="Enter new class..." required>
            <button>+ Add Class</button>
        </form>
    </div>

</div>

<!-- Header -->
<div class="header">
    <div class="logo">AniNotes</div>
    <div class="welcome">Welcome, <?php echo $_SESSION['user']; ?> !!!!!!!!</div>
    <a class="logout" href="logout.php">Logout</a>
</div>

<!-- Main -->
<div class="main">

<?php if($class_id): 

$class = $db->query("SELECT * FROM classes WHERE id='$class_id'")->fetchArray();

if($class):
?>

<!-- Class Title -->
<div class="class-title"><?php echo $class['name']; ?></div>
<div class="subtitle">This is what you have learned till now in this class ✨</div>

<!-- Add Subject -->
<div class="add-subject-box">
<form method="POST" action="add_subject.php">
    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
    <input type="text" name="subject" placeholder="✨ Add a new subject..." required>
    <button>Create</button>
</form>
</div>

<hr>

<?php
echo "<div class='subject-grid'>";

$subjects = $db->query("SELECT * FROM subjects WHERE class_id='$class_id'");
$hasSubjects = false;

while($s = $subjects->fetchArray()){
    $hasSubjects = true;

    echo "<div class='subject-card'>";

    // HEADER
    echo "<div class='card-header'>";
    echo "<h3>📘 {$s['name']}</h3>";

    echo "
    <form class='upload-form' action='upload.php' method='POST' enctype='multipart/form-data'>
        <input type='hidden' name='subject_id' value='{$s['id']}'>
        
        <label class='custom-file'>
            <input type='file' name='file' required onchange='showFileName(this)'>
            <span>Choose File</span>
        </label>

        <span class='file-name'>No file</span>

        <button>Upload</button>
    </form>
    ";

    echo "</div>";

    // FILE LIST
    $files = $db->query("SELECT * FROM files WHERE subject_id='{$s['id']}'");

    echo "<div class='file-list'>";

    while($f = $files->fetchArray()){
        echo "<div class='file'>
            📄 <a href='{$f['filepath']}' target='_blank'>{$f['filename']}</a>

            <form action='delete.php' method='POST' style='display:inline;'>
                <input type='hidden' name='id' value='{$f['id']}'>
                <button class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this file?\")'>X</button>
            </form>
        </div>";
    }

    echo "</div>";
    echo "</div>";
}

echo "</div>";

if(!$hasSubjects){
    echo "<p>No subjects yet. Create one above 👆</p>";
}
?>

<?php else: ?>
<p>Invalid class selected</p>
<?php endif; ?>

<?php else: ?>
<h2>No Class Found</h2>
<p>Create your first class from the sidebar 👈</p>
<?php endif; ?>

<!-- Footer -->
<div class="footer">
    AniNotes is your personal learning vault — a space where every file you upload tells a story of growth.  
    Come back anytime to revisit what shaped your journey, what you learned, and how far your mind has evolved. 🌱✨
</div>

</div>

<!-- JS for file name -->
<script>
function showFileName(input){
    const fileName = input.files[0]?.name || "No file";
    input.closest('.upload-form').querySelector('.file-name').innerText = fileName;
}
</script>