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

       $stmt = $this->db->prepare("SELECT * FROM doctor WHERE Division = :area");
       $stmt->bindValue(':area', $area);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_ASSOC);

   }

   public function searchDoctorsBySpeciality($speciality)
   {
       $specialityx = trim($speciality); // No need for mysql_real_escape_string with PDO
       $stmt = $this->db->prepare("SELECT * FROM doctor WHERE Speciality LIKE :speciality");
       $stmt->bindValue(':speciality', "%$specialityx%", PDO::PARAM_STR); // Binding the parameter correctly
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}

$doctor = new Doctor(Teledoc::connect());

if (isset($_GET['area'])) {
   $doctors = $doctor->searchDoctorsByArea($_GET['area']);
} elseif (isset($_GET['speciality'])) {
   $doctors = $doctor->searchDoctorsBySpeciality($_GET['speciality']);
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
        <img src="1.jpg" class="background-image active" alt="Background Image">
        <img src="2.jpg" class="background-image" alt="Background Image">
        <img src="3.jpg" class="background-image" alt="Background Image">
    </div>
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
        <h2>Search Doctors</h2>
        <form action="search.php" method="GET">
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
                        <td><?php echo $doctor['Name']; ?></td>
                        <td><?php echo $doctor['Email']; ?></td>
                        <td><?php echo $doctor['Degree']; ?></td>
                        <td><?php echo $doctor['Speciality']; ?></td>
                        <td><?php echo $doctor['Division']; ?></td>
                        <td><?php echo $doctor['ChamberNumber']; ?></td>
                        <td><?php echo $doctor['Hospital']; ?></td>
                        <td><?php echo $doctor['ChamberLocation']; ?></td>
                        <td><?php echo $doctor['VisitCharge']; ?></td>
                        <td><?php echo $doctor['TimeStart'] . ' - ' . $doctor['TimeEnd']; ?></td>
                        <td><a href="appointment.php?IndexNumber=<?php echo $doctor['IndexNumber']; ?>">Book</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
