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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $degree = $_POST['degree'];
    $speciality = $_POST['speciality'];
    $division = $_POST['division'];
    $chamber_number = $_POST['chamber_number'];
    $hospital = $_POST['hospital'];
    $chamber_location = $_POST['chamber_location'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $password = $_POST['password'];
    $visitcharge = $_POST['visitcharge'];

    // Prepare SQL statement

    // INSERT INTO `doctor` (`IndexNumber`, ``, , `Password`, , ``, ``, ``, `TimeStart`, `TimeEnd`, `VisitCharge`) VALUES

    $query = "INSERT INTO info
    (Name, Email, Degree, Speciality, Division, ChamberNumber, Hospital, ChamberLocation, TimeStart, TimeEnd, password,VisitCharge)
    VALUES
    (:name, :email, :degree, :speciality, :division, :chamber_number, :hospital, :chamber_location, :time_start, :time_end, :password,:visitcharge)";
    
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':degree', $degree);
    $stmt->bindParam(':speciality', $speciality);
    $stmt->bindParam(':division', $division);
    $stmt->bindParam(':chamber_number', $chamber_number);
    $stmt->bindParam(':hospital', $hospital);
    $stmt->bindParam(':chamber_location', $chamber_location);
    $stmt->bindParam(':time_start', $time_start);
    $stmt->bindParam(':time_end', $time_end);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':visitcharge', $visitcharge);

    // Execute the query
    try {
        $stmt->execute();
        echo "New Doctor Added inserted successfully!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

require('header.php');
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Admin | Add Doctor</h3>
                </div>
                <div class="card-body">
                    <div class="form-group d-flex flex-column">
                        <label for="username" class="font-weight-bold">Username:</label>
                        <input type="text" readonly class="form-control" id="username" value="<?php echo $user['name']; ?>">
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="total_doctors" class="font-weight-bold">Total Registered Doctor</label>
                        <input type="text" readonly class="form-control" id="total_doctors" value="<?php echo $docnumber; ?>">
                    </div>
                    <div class="table-responsive mt-4">
                        <!-- Form for adding new doctor -->
                        <form action="" method="post" id="addDoctorForm">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <label for="degree">Degree:</label>
                                <input type="text" class="form-control" id="degree" name="degree" placeholder="Enter Degree" required>
                            </div>
                            <div class="form-group">
                                <label for="speciality">Speciality:</label>
                                <input type="text" class="form-control" id="speciality" name="speciality" placeholder="Enter Speciality" required>
                            </div>
                            <div class="form-group">
                                <label for="division">Division:</label>
                                <select class="form-control" id="division" name="division" required>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="chamber_number">Chamber Number:</label>
                                <input type="text" class="form-control" id="chamber_number" name="chamber_number" placeholder="Enter Chamber Number" required>
                            </div>
                            <div class="form-group">
                                <label for="hospital">Hospital Name:</label>
                                <input type="text" class="form-control" id="hospital" name="hospital" placeholder="Enter Hospital" required>
                            </div>
                            <div class="form-group">
                                <label for="chamber_location">Chamber Location:</label>
                                <input type="text" class="form-control" id="chamber_location" name="chamber_location" placeholder="Enter Chamber Location" required>
                            </div>
                            <div class="form-group">
                                <label for="time_start">Time Start:</label>
                                <input type="time" class="form-control" id="time_start" name="time_start" required>
                            </div>
                            <div class="form-group">
                                <label for="time_end">Time End:</label>
                                <input type="time" class="form-control" id="time_end" name="time_end" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="visitcharge">Visit Charge:</label>
                                <input type="number" class="form-control" id="visitcharge" name="visitcharge" placeholder="Enter Visit Charge" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirmed Password" required>
                                <small id="passwordHelpBlock" class="form-text text-danger"></small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="doctor_logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('addDoctorForm').addEventListener('submit', function(event) {
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirm_password').value;
            let error = document.getElementById('passwordHelpBlock');

            if (password !== confirmPassword) {
                error.textContent = "Passwords do not match!";
                event.preventDefault(); // Prevent form submission
            } else {
                error.textContent = ""; // Clear error message if passwords match
            }
        });
    });
</script>


<?php require("footer.php"); ?>
