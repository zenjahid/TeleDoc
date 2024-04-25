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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment with <?php echo $doctor['Name']; ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Navbar */
        .navbar {
            background-color: #3f51b5 !important; /* Change navbar background color */
        }

        .navbar-brand {
            color: #ffffff !important; /* Change navbar brand text color */
        }

        .navbar-nav .nav-link {
            color: #ffffff !important; /* Change navbar links text color */
        }

        .navbar-nav .nav-link:hover {
            color: #ffeb3b !important; /* Change navbar links text color on hover */
        }

        /* Main Content */
        .main-content {
            background-color: #f5f5f5; /* Change main content background color */
            padding: 30px;
            border-radius: 10px;
        }

        /* Text */
        h1, h2, h3, h4, h5, h6 {
            color: #3f51b5; /* Change heading text color */
            text-align: center; /* Center align headings */
        }

        p {
            color: #333; /* Change paragraph text color */
            text-align: center; /* Center align paragraphs */
        }

        /* Appointment Form */
        .appointment-form {
            max-width: 500px;
            margin: 0 auto; /* Center align form */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: not-allowed;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #3f51b5;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2c3e50;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
<?php
  require 'navbar.php';
    ?>
    <!-- Main Content -->
    <div class="container mt-5 main-content">
        <h1>Book Appointment with <?php echo $doctor['Name']; ?></h1>
        <div class="row">
            <div class="col-md-6">
                <div class="wrapper">
                    <div class="card">
                        <div class="profile-img">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/024/959/162/small_2x/hand-drawn-vintage-doctor-logo-in-flat-style-png.png" alt="Doctor">
                        </div>
                        <div class="content">
                            <ul type="None">   
                                <li>Email: <?php echo $doctor['Email']; ?></li>
                                <li>Degree: <?php echo $doctor['Degree']; ?></li>
                                <li>Speciality: <?php echo $doctor['Speciality']; ?></li>
                                <li>Division: <?php echo $doctor['Division']; ?></li>
                                <li>Chamber Contact NO: <?php echo $doctor['ChamberNumber']; ?></li>
                                <li>Hospital: <?php echo $doctor['Hospital']; ?></li>
                                <li>Chamber Location: <?php echo $doctor['ChamberLocation']; ?></li>
                                <li>Charge: <?php echo $doctor['VisitCharge']; ?></li>
                                <li>Start: <?php echo $doctor['TimeStart'] . ' To ' . $doctor['TimeEnd']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Appointment Form -->
                <div class="appointment-form">
                    <h2>Available Appointment Times</h2>
                    <form action="book_appointment.php" method="post">
                        <input type="hidden" name="doctorId" value="<?php echo $doctorId; ?>">
                        <div class="form-group">
                            <label for="appointmentDate">Appointment Date:</label> 
                            <input type="date" name="appointmentDate" id="appointmentDate" value="<?php echo date("Y-m-d") ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="appointmentTime">Appointment Time:</label>
                            <select name="appointmentTime" id="appointmentTime" required>
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
                                    $startTimeObj = new DateTime($doctor['TimeStart']);
                                    $endTimeObj = new DateTime($doctor['TimeEnd']);
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
                        </div>
                        <div class="form-group">
                            <label for="charge">Cost:</label>
                            <input type="text" name="charge" id="charge" value="<?php echo $doctor['VisitCharge']; ?>" readonly>
                        </div>
                        <input type="submit" value="Book Appointment" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
