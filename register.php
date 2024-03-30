<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TeleDoc</title>
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
    <?php
        require('./connection.php');
        if(isset($_POST['signup'])){
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $p = teledoc::connect()->prepare('INSERT INTO info (email,name,pass) VALUES (:e,:u,:p)');
            $p->bindValue(':e', $email);
            $p->bindValue(':u', $username);
            $p->bindValue(':p', $password);
            $p->execute();
            echo '<script>alert("You have been registered!");</script>';
            header('location: login.php');
        }
    ?>
    <div class="container">
        <h2>Register</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input required type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input required type="password" id="password" name="password">
            </div>
            <button type="submit" class="large-button" value="Sign UP" name="signup">Register</button>
        </form>
        <p>Already Registered! <a href="login.php">Log In Here!</a></p>
    </div>
</body>
</html>
