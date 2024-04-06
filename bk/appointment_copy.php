<?php
session_start();
require_once('connection.php');

class Doctor
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getDoctorById($doctorId)
    {
        $stmt = $this->db->prepare("SELECT * FROM doctor WHERE IndexNumber = :doctorId");
        $stmt->bindParam(':doctorId', $doctorId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAvailableAppointmentTimes($doctorId)
    {
        $stmt = $this->db->prepare("SELECT * FROM doctor_availability WHERE doctor_id = :doctorId");
        $stmt->bindParam(':doctorId', $doctorId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$doctor = new Doctor(Teledoc::connect());

// $doctorId = $_POST["doctorId"]; // Moved this line below class declaration
// echo $doctorId; // Ensure this line is needed where it is

if (isset($_POST['doctorId'])) {
    $doctorId = $_POST['doctorId'];
    $doctorDetails = $doctor->getDoctorById($doctorId);
    $appointmentTimes = $doctor->getAvailableAppointmentTimes($doctorId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="design.css">
    <title>Book Appointment with Dr. <?php echo isset($doctorDetails['Name']) ? $doctorDetails['Name'] : 'Unknown'; ?></title>
</head>

<body>
    <?php require("background.php"); ?>
    <h1>TeleDoc</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contract</a></li>
            <?php if (isset($_SESSION['username'])) : ?>
                <li><a href="logout.php" class="large-button">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
            <?php else : ?>
                <li><a href="register.php" class="large-button">Register</a></li>
                <li><a href="login.php" class="large-button">Log In</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container">
        <?php if (isset($doctorDetails)) : ?>
            <h1>Dr. <?php echo $doctorDetails['Name']; ?></h1>
            <div class="wrapper">
                <div class="card">
                    <div class="profile-img">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/024/959/162/small_2x/hand-drawn-vintage-doctor-logo-in-flat-style-png.png" alt="Doctor">
                    </div>
                    <div class="content">
                        <ul type="None">
                            <li>Email:<?php echo $doctorDetails['Email']; ?></li>
                            <li>Degree:<?php echo $doctorDetails['Degree']; ?></li>
                            <li>Speciality:<?php echo $doctorDetails['Speciality']; ?></li>
                            <li>Division:<?php echo $doctorDetails['Division']; ?></li>
                            <li>Chamber Contact NO:<?php echo $doctorDetails['ChamberNumber']; ?></li>
                            <li>Hospital:<?php echo $doctorDetails['Hospital']; ?></li>
                            <li>Chamber Location:<?php echo $doctorDetails['ChamberLocation']; ?></li>
                            <li>Charge:<?php echo $doctorDetails['VisitCharge']; ?></li>
                            <li>Start:<?php echo $doctorDetails['TimeStart'] . ' To ' . $doctorDetails['TimeEnd']; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <h2>Available Appointment Times</h2>
    <?php if (isset($appointmentTimes)) : ?>
        <?php foreach ($appointmentTimes as $time) : ?>
            <p><?php echo $time['appointment_time']; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="appointment.php" method="post">
        <input type="hidden" name="doctorId" value="<?php echo $doctorId; ?>">
        <label>Appointment Date:</label>
        <input type="date" name="appointmentDate">
        <label>Appointment Time:</label>
        <select name="appointmentTime">
            <?php if (isset($appointmentTimes)) : ?>
                <?php foreach ($appointmentTimes as $time) : ?>
                    <option value="<?php echo $time['appointment_time']; ?>"><?php echo $time['appointment_time']; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <input type="submit" value="Book Appointment">
    </form>
</body>

</html>
