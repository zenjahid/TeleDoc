<?php
session_start();
require('./connection.php');

if(isset($_POST['login'])){
    $_SESSION['validate'] = false;
    $email = $_POST['email'];
    $password = $_POST['password'];

    $p = Teledoc::connect()->prepare('SELECT * FROM doctor WHERE Email=:e');
    $p->bindValue(':e', $email);
    $p->execute();
    $user = $p->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        $storedPassword = $user['Password'];
        
        if ($password === $storedPassword) {
            $_SESSION['doctor_email'] = $email;
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
    <title>Doctor Login - TeleDoc</title>
    <link rel="stylesheet" href="design.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
            <li><a href="search.php">Search</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contract</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>Doctor Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input required type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" id="password" name="password">
            </div>
            <button type="submit" class="large-button" value="login_button" name="login">Login</button>
        </form>
    </div>
</body>
</html>
