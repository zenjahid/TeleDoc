<?php
require_once('../connection.php');
session_start();

try {
    $conn = Teledoc::connect();

    // Fetch user details
    $query = "SELECT * FROM info WHERE user_type = 0 AND id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch doctors' information
    $query = "SELECT * FROM doctor";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // delete doctor 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['doctor_id'])) {
    try {
        $conn = Teledoc::connect();

        $queryz = "DELETE FROM doctor WHERE IndexNumber = :doctor_id";
        $stmtz = $conn->prepare($queryz);
        $stmtz->bindParam(':doctor_id', $_POST['doctor_id']);
        $stmtz->execute();
        
            echo '<script>alert("Doctor Deleted successfully!");</script>';
            header('location:profile.php');
        exit();
    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}






} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

require('header.php');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Admin | Manage Doctors</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Email</th>
                                    <th>Degree</th>
                                    <th>Speciality</th>
                                    <th>Division</th>
                                    <!-- <th>Chamber Number</th> -->
                                    <!-- <th>Hospital</th> -->
                                    <!-- <th>Chamber Location</th> -->
                                    <!-- <th>Time Start</th> -->
                                    <!-- <th>Time End</th> -->
                                    <th>Visit Charge</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($doctors as $doctor): ?>
                                    <tr>
                                        <td><?php echo $doctor['Name']; ?></td>
                                        <td><?php echo $doctor['Email']; ?></td>
                                        <td><?php echo $doctor['Degree']; ?></td>
                                        <td><?php echo $doctor['Speciality']; ?></td>
                                        <td><?php echo $doctor['Division']; ?></td>
                                        <!-- <td><?php echo $doctor['ChamberNumber']; ?></td> -->
                                        <!-- <td><?php echo $doctor['Hospital']; ?></td> -->
                                        <!-- <td><?php echo $doctor['ChamberLocation']; ?></td> -->
                                        <!-- <td><?php echo $doctor['TimeStart']; ?></td> -->
                                        <!-- <td><?php echo $doctor['TimeEnd']; ?></td> -->
                                        <td><?php echo $doctor['VisitCharge']; ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="doctor_id" value="<?php echo $doctor['IndexNumber']; ?>">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="doctor_logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require("footer.php"); ?>
