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
    <link rel="stylesheet" href="css/design.css">
    <title>Book Appointment with <?php echo $doctor['Name']; ?></title>
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
    <h1> <?php echo $doctor['Name']; ?></h1>
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
<!--Below is Appointment Form-->
    <h2>Available Appointment Times</h2>

    <?php
try {
    $conn = Teledoc::connect();
    $startEndTimeQuery = "SELECT TimeStart, TimeEnd FROM doctor WHERE IndexNumber = :doctorId";
    $startEndTimeStmt = $conn->prepare($startEndTimeQuery);
    $startEndTimeStmt->bindParam(':doctorId', $doctorId);
    $startEndTimeStmt->execute();
    $doctorTimes = $startEndTimeStmt->fetch(PDO::FETCH_ASSOC);

    $startTime = $doctorTimes['TimeStart'];
    $endTime = $doctorTimes['TimeEnd'];


    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    ?>

    <form action="book_appointment.php" method="post">
        <input type="hidden" name="doctorId" value="<?php echo $doctorId; ?>">
        <label>Appointment Date:</label> 
        <input type="date"  name="appointmentDate" value="<?php echo date("Y-m-d") ?>" required>
<?php
$_POST['doc_id'] = $doctorId;
?>

<!-- v2 -->
<label>Appointment Time:</label>
<select name="appointmentTime" required>
    <?php
    try {
        // Prepare query to select appointment times to exclude
        $excludeQuery = "SELECT d.appointment_time FROM doctor e INNER JOIN doctor_availablity d ON e.IndexNumber = d.doc_id WHERE e.IndexNumber = :doctorId";
        $excludeStmt = $conn->prepare($excludeQuery);
        $excludeStmt->bindParam(':doctorId', $doctorId);
        $excludeStmt->execute();


        // Fetch the appointment times to exclude
        $excludeTimes = [];
        while ($row = $excludeStmt->fetch(PDO::FETCH_ASSOC)) {
            $excludeTimes[] = $row['appointment_time'];
        }

        // Generate appointment options in 1-hour intervals, excluding the appointment times to exclude
        $startTimeObj = new DateTime($startTime);
        $endTimeObj = new DateTime($endTime);
        $interval = new DateInterval('PT1H'); // 1 hour interval
        $appointmentTime = clone $startTimeObj;
        while ($appointmentTime < $endTimeObj) {
            $appointmentTimeString = $appointmentTime->format('H:i:s');
            if (!in_array($appointmentTimeString, $excludeTimes)) {
                echo '<option value="' . $appointmentTimeString . '">' . $appointmentTimeString . '</option>';
            }
            $appointmentTime->add($interval);
        }
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    ?>
</select>
<br>
<label for="charge">Cost : </label>
<input type="text" name="charge" value="<?php echo $doctor['VisitCharge']; ?>" readonly>

<input type="submit" value="Book Appointment">
</form>

</body>

</html>
