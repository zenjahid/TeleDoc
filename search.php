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
        }

        p {
            color: #333; /* Change paragraph text color */
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
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Search Doctors</h1>
                <form action="search.php" method="post">
                    <div class="form-group">
                        <label for="area">Search by Area:</label>
                        <select name="area" id="area" class="form-control">
                            <option value="" default>All</option>
                            <?php
                            // Retrieve all unique divisions regardless of search results
                            $uniqueDivisions = array_unique(array_column($doctor->getAllDoctors(), 'Division'));
                            foreach ($uniqueDivisions as $division) :
                                ?>
                                <option value="<?php echo $division; ?>" <?php if(isset($_POST['area']) && $_POST['area'] == $division) echo "selected"; ?>><?php echo $division; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="speciality">Search by Speciality:</label>
                        <input type="text" class="form-control" id="speciality" name="speciality" placeholder="Enter speciality" value="<?php if(isset($_POST['speciality'])) echo $_POST['speciality']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table displaying doctors -->
    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table">
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
                                    <button type="submit" class="btn btn-primary">Book</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
