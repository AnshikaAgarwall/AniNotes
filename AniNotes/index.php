<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $result = $db->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
    
    if($result){
        $user = $result->fetchArray();

        if($user){
            $_SESSION['user'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid Email or Password";
        }
    } else {
        $error = "Database error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AniNotes Login</title>
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

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .title {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            color: #ccc;
        }

        /* Signup link styling */
        .signup {
            text-align: center;
            margin-top: 15px;
        }

        .signup a {
            color: #b388ff;
            text-decoration: none;
            font-weight: bold;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>AniNotes</h2>
    <div class="title">Login to continue</div>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <!-- ✅ SIGNUP BUTTON -->
    <div class="signup">
        New user? <a href="register.php">Sign Up</a>
    </div>

</div>

</body>
</html>