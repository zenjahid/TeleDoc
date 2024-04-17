<?php
// Database connection
require '../connection.php';
if(isset($_POST['check_email'])) {
    $email = $_POST['check_email'];

    try {
        $pdo = Teledoc::connect();
        
        $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM info WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];

        if ($count > 0) {
            echo json_encode(array("available" => false));
        } else {
            echo json_encode(array("available" => true));
        }
    } catch(PDOException $e) {
        echo json_encode(array("error" => "Database query error: " . $e->getMessage()));
    }
}
?>
