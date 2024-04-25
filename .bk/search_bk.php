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

    public function searchDoctors($area, $speciality)
    {
        $area = trim($area);
        $speciality = trim($speciality);

        $sql = "SELECT * FROM doctor WHERE 1";

        if (!empty($area)) {
            $sql .= " AND Division LIKE :area";
        }

        if (!empty($speciality)) {
            $sql .= " AND Speciality LIKE :speciality";
        }

        $stmt = $this->db->prepare($sql);

        if (!empty($area)) {
            $stmt->bindValue(':area', "%$area%", PDO::PARAM_STR);
        }

        if (!empty($speciality)) {
            $stmt->bindValue(':speciality', "%$speciality%", PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$doctor = new Doctor(Teledoc::connect());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $area = isset($_POST['area']) ? $_POST['area'] : "";
    $speciality = isset($_POST['speciality']) ? $_POST['speciality'] : "";
    $doctors = $doctor->searchDoctors($area, $speciality);
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
    <link rel="stylesheet" href="css/design.css">
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
            <select name="area" id="area">
                <option value="" default>All</option>
                <?php
                // Retrieve all unique divisions regardless of search results
                $uniqueDivisions = array_unique(array_column($doctor->getAllDoctors(), 'Division'));
                foreach ($uniqueDivisions as $division) :
                    ?>
                    <option value="<?php echo $division; ?>" <?php if(isset($_POST['area']) && $_POST['area'] == $division) echo "selected"; ?>><?php echo $division; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="speciality">Search by Speciality:</label>
            <input type="text" name="speciality" id="speciality" placeholder="Enter speciality" value="<?php if(isset($_POST['speciality'])) echo $_POST['speciality']; ?>">
            <button type="submit" class="large-button">Search</button>
        </form>
    </div>

    <div class="table-responsive">
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