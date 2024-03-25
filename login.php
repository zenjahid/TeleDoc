<?php
session_start();
require('./connection.php');

if(isset($_POST['login'])){
    $_SESSION['validate'] = false;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $p = teledoc::connect()->prepare('SELECT * FROM info WHERE name=:u');
    $p->bindValue(':u', $username);
    $p->execute();
    $user = $p->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        $storedPassword = $user['pass'];
        
        if ($password === $storedPassword) {
            $_SESSION['username'] = $username;
            $_SESSION['validate'] = true;
            echo '<script>alert("You have been logged in!"); window.location.href = "index.php";</script>';
            exit;
        } else {  
            echo '<script>alert("Password mismatch!");</script>';
        }
    } else {
        echo '<script>alert("User not found!");</script>';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TeleDoc</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <div id="background-slideshow">
        <img src="1.jpg" class="background-image active" alt="Background Image">
        <img src="2.jpg" class="background-image" alt="Background Image">
        <img src="3.jpg" class="background-image" alt="Background Image">
    </div>
    <h1>TeleDoc</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contract</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <h2>Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" id="password" name="password">
            </div>
            <button type="submit" class="large-button" value="login_button" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register Here!</a></p>
    </div>
</body>
</html>
