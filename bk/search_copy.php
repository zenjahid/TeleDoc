<?php
session_start();
require_once('./connection.php');

class Doctor
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllDoctors()
    {
        $stmt = $this->db->prepare("SELECT * FROM doctor");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchDoctorsByArea($area)
    {
        $area = trim($area); // No need for additional escaping with PDO
        $stmt = $this->db->prepare("SELECT * FROM doctor WHERE Division LIKE :area");
        $stmt->bindValue(':area', "%$area%", PDO::PARAM_STR); // Binding the parameter correctly
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchDoctorsBySpeciality($speciality)
    {
        $specialityx = trim($speciality); // No need for additional escaping with PDO
        $stmt = $this->db->prepare("SELECT * FROM doctor WHERE Speciality LIKE :speciality");
        $stmt->bindValue(':speciality', "%$specialityx%", PDO::PARAM_STR); // Binding the parameter correctly
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$doctor = new Doctor(Teledoc::connect());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['area'])) {
        $doctors = $doctor->searchDoctorsByArea($_POST['area']);
    } elseif (isset($_POST['speciality'])) {
        $doctors = $doctor->searchDoctorsBySpeciality($_POST['speciality']);
    } else {
        $doctors = $doctor->getAllDoctors();
    }
} else {
    $doctors = $doctor->getAllDoctors();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Doctors - TeleDoc</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
<div id="background-slideshow">
    <img src="img/1.jpg" class="background-image active" alt="Background Image">
    <img src="img/2.jpg" class="background-image" alt="Background Image">
    <img src="img/3.jpg" class="background-image" alt="Background Image">
</div>
<h1>TeleDoc</h1>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contract</a></li>
        <?php if(isset($_SESSION['username'])): ?>
            <li><a href="logout.php" class="large-button">Logout (<?= $_SESSION['username'] ?>)</a></li>
        <?php else: ?>
            <li><a href="register.php" class="large-button">Register</a></li>
            <li><a href="login.php" class="large-button">Log In</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="container">
    <h2>Search Doctors</h2>
    <form action="search.php" method="post">
        <label for="area">Search by Area:</label>
        <input type="text" name="area" id="area" placeholder="Enter area">
        <label for="speciality">Search by Speciality:</label>
        <input type="text" name="speciality" id="speciality" placeholder="Enter speciality">
        <button type="submit" class="large-button">Search</button>
    </form>
</div>

<div class="container">
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Degree</th>
            <th>Speciality</th>
            <th>Division</th>
            <th>Chamber Number</th>
            <th>Hospital</th>
            <th>Chamber Location</th>
            <th>Visit Charge</th>
            <th>Time Schedule</th>
            <th>Book an appointment</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($doctors as $index => $doctor) : ?>
            <tr>
                <td><?= htmlspecialchars($doctor['Name']) ?></td>
                <td><?= htmlspecialchars($doctor['Email']) ?></td>
                <td><?= htmlspecialchars($doctor['Degree']) ?></td>
                <td><?= htmlspecialchars($doctor['Speciality']) ?></td>
                <td><?= htmlspecialchars($doctor['Division']) ?></td>
                <td><?= htmlspecialchars($doctor['ChamberNumber']) ?></td>
                <td><?= htmlspecialchars($doctor['Hospital']) ?></td>
                <td><?= htmlspecialchars($doctor['ChamberLocation']) ?></td>
                <td><?= htmlspecialchars($doctor['VisitCharge']) ?></td>
                <td><?= htmlspecialchars($doctor['TimeStart']) . ' - ' . htmlspecialchars($doctor['TimeEnd']) ?></td>
                <td>
                    <form action="appointment.php" method="post">
                        <input type="hidden" name="doctorId" value="<?= htmlspecialchars($doctor['IndexNumber']) ?>">
                        <button type="submit">Book</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
