<?php
require_once('./connection.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo '<script>alert("You are not logged in. Please login first.");</script>';
    header('Location: login.php');
    exit();
}
extract($_POST);
try {
    $conn = Teledoc::connect();

    $Query="insert into doctor_availablity(doc_id,user_id,appointment_time,date,cost) VALUES(:doc_id,:user_id,:appointment_time,:date,:cost);";
    $Stmt = $conn->prepare($Query);
    $Stmt->bindParam(':doc_id',$doc_id);
    $Stmt->bindParam(':user_id',$user_id);
    $Stmt->bindParam(':appointment_time',$appointment_time);
    $Stmt->bindParam(':date',$appointment_date);
    $Stmt->bindParam(':cost',$cost);
    $Stmt->execute();

    echo '<script>alert("Successfully Booked");</script>';
    header('Location: index.php');
    exit();
} 
catch(PDOException $e)
{
    echo 'Error: ' . $e->getMessage();
}
?>
