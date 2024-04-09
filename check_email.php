<?php
// Database connection
require 'connection.php';

// Check if the email parameter is set
if(isset($_GET['email'])) {
    $email = $_GET['email'];

    // Query to check if the email exists in the database
    $query = "SELECT COUNT(*) AS count FROM info WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the count is greater than 0, email is already taken
    if($result['count'] > 0) {
        echo json_encode(array('available' => false));
    } else {
        echo json_encode(array('available' => true));
    }
} else {
    // If the email parameter is not set, return an error
    echo json_encode(array('error' => 'Email parameter is missing'));
}
?>
