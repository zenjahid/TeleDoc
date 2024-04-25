<?php
require_once('./connection.php');

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Prepare the SQL statement
        $stmt = teledoc::connect()->prepare('INSERT INTO info (email, name, pass, user_type) VALUES (:e, :u, :p, 2)');
        // Bind parameters
        $stmt->bindParam(':e', $email);
        $stmt->bindParam(':u', $username);
        $stmt->bindParam(':p', $password);
        // Execute the query
        $stmt->execute();
        // Redirect to index.php after successful registration
        header('Location: login.php');
        exit();
    } catch (PDOException $e) {
        // Echo the error message
        echo "Error: " . $e->getMessage();
        // Optionally, log the error to a file or database for further analysis
    }

?>
