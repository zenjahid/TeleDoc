<?php
require_once('./connection.php');

session_start();

$doctorId = $_POST['doctorId'];

try {
    $conn = Teledoc::connect();

    $query = "SELECT * FROM doctor WHERE IndexNumber = :doctorId";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':doctorId', $doctorId);

    $stmt->execute();

    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="design.css">
    <title>Book Appointment with Dr. <?php echo $doctor['Name']; ?></title>
</head>

<body>

<?php 
require("background.php");
?>
    <h1>TeleDoc</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contract</a></li>
            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="logout.php" class="large-button">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
            <?php else: ?>
                <li><a href="register.php" class="large-button">Register</a></li>
                <li><a href="login.php" class="large-button">Log In</a></li>
            <?php endif; ?>
        </ul>
    </nav> 
    <div class="container">
    <h1>Dr. <?php echo $doctor['Name']; ?></h1>
        <div class="wrapper">
            <div class="card">
                <div class="profile-img">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/024/959/162/small_2x/hand-drawn-vintage-doctor-logo-in-flat-style-png.png" alt="Doctor">
                </div>
                <div class="content">
                    <ul type="None">   
                        <li>Email:<?php echo $doctor['Email']; ?></li>
                        <li>Degree:<?php echo $doctor['Degree']; ?></li>
                        <li>Speciality:<?php echo $doctor['Speciality']; ?></li>
                        <li>Division:<?php echo $doctor['Division']; ?></li>
                        <li>Chamber Contact NO:<?php echo $doctor['ChamberNumber']; ?></li>
                        <li>Hospital:<?php echo $doctor['Hospital']; ?></li>
                        <li>Chamber Location:<?php echo $doctor['ChamberLocation']; ?></li>
                        <li>Charge:<?php echo $doctor['VisitCharge']; ?></li>
                        <li>Start:<?php echo $doctor['TimeStart'] . ' To ' . $doctor['TimeEnd']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<!--Beloow is Appointment Form-->
    <h2>Available Appointment Times</h2>

    <?php

    try {
        $query = "SELECT * FROM doctor_availability WHERE doctor_id = :doctorId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':doctorId', $doctorId);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<p>' . $row['appointment_time'] . '</p>';
        }

    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    ?>

    <form action="appointment.php" method="post">
        <input type="hidden" name="doctorId" value="<?php echo $doctorId; ?>">
        <label>Appointment Date:</label>
        <input type="date" name="appointmentDate">
        <label>Appointment Time:</label>
        <select name="appointmentTime">
            <?php
            try {
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option>' . $row['appointment_time'] . '</option>';
                }
            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            ?>
        </select>
        <input type="submit" value="Book Appointment">
    </form>

</body>

</html>