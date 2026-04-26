<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

if(isset($_POST['register'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if email already exists
    $check = $db->query("SELECT * FROM users WHERE email='$email'");

    if($check && $check->fetchArray()){
        echo "<script>alert('Email already registered!');</script>";
    } else {
        $result = $db->exec("INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')");

        if($result){
            echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Database insert failed');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AniNotes Signup</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #0f0f0f;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .box {
            background: #1c1c1c;
            padding: 30px;
            border-radius: 12px;
            width: 320px;
        }

        h2 {
            text-align: center;
            color: #b388ff;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 6px;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #8a2be2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #6a1bbd;
        }

        .title {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            color: #ccc;
        }

        .link {
            text-align: center;
            margin-top: 10px;
        }

        .link a {
            color: lavender;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>AniNotes</h2>
    <div class="title">Create your account</div>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Create Password" required>
        <button type="submit" name="register">Sign Up</button>
    </form>

    <div class="link">
        Already user? <a href="index.php">Login</a>
    </div>
</div>

</body>
</html>