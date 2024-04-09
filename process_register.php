<?php
require_once('connection.php');

function isEmailTaken($email) {
    $stmt = teledoc::connect()->prepare('SELECT COUNT(*) FROM info WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count > 0;
}

function isUsernameTaken($username) {
    $stmt = teledoc::connect()->prepare('SELECT COUNT(*) FROM info WHERE name = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count > 0;
}

function validatePassword($password) {
    // Password must be at least 8 characters long and contain at least one number and one character
    return preg_match('/^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/', $password);
}

if(isset($_POST['signup'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!validatePassword($password)) {
        echo '<script>alert("Password must be at least 8 characters long and contain at least one number and one character!");</script>';
        exit();
    } elseif(isEmailTaken($email)) {
        echo '<script>alert("This email is already taken!");</script>';
        exit();
    } elseif(isUsernameTaken($username)) {
        echo '<script>alert("This username is already taken!");</script>';
        exit();
    } else {
        // Hashing the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = teledoc::connect()->prepare('INSERT INTO info (email, name, pass) VALUES (:e, :u, :p)');
            $stmt->bindParam(':e', $email);
            $stmt->bindParam(':u', $username);
            $stmt->bindParam(':p', $hashedPassword);
            $stmt->execute();
            header('Location: login.php');
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
