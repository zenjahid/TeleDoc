<?php
require_once('../connection.php');
session_start();

try {
    $conn = Teledoc::connect();

    // Fetch user details
    $query = "SELECT * FROM doctor WHERE IndexNumber = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch appointment details
    $query = "SELECT d.appointment_time, d.date, d.cost, i.name 
              FROM doctor_availablity d 
              INNER JOIN info i ON i.id = d.user_id 
              WHERE d.doc_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();

    // Calculate total earning
    $totalEarning = 0;
    while ($user_details = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $totalEarning += ($user_details['cost']*.9);
    }

} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$query = "DELETE FROM doctor_availablity WHERE app_id = :app_id;";
$appstmt = $conn->prepare($query);
$appstmt->bindParam(':app_id', $_POST['app_id']);
$appstmt->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        .card {
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #8ecae6; /* Changed to light blue */
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: none;
            border-radius: 0 0 10px 10px;
        }

        .btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: bold;
        }

        /* Dark mode */
        body.dark-mode {
            background-color: #343a40; /* Dark background color */
            color: #fff; /* Light text color */
        }

        .dark-mode .card-header {
            background-color: #212529; /* Dark header background color */
        }

        .dark-mode .card-footer {
            background-color: #343a40; /* Dark footer background color */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Profile</h3>
                </div>
                <div class="card-body">
                    <div class="form-group d-flex flex-column">
                        <label for="username" class="font-weight-bold">Username:</label>
                        <input type="text" readonly class="form-control" id="username" value="<?php echo $user['Name']; ?>">
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="email" class="font-weight-bold">Email:</label>
                        <input type="email" readonly class="form-control" id="email" value="<?php echo $user['Email']; ?>">
                    </div>
                    <!-- Table to display appointment details -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Appointment Time</th>
                                    <th>Date</th>
                                    <th>Earning</th>
                                    <!-- <th>Action</th> New column for action buttons -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $stmt->execute(); // Re-execute the query to fetch all rows again
                                while ($user_details = $stmt->fetch(PDO::FETCH_ASSOC)): 
                                ?>
                                    <tr>
                                        <td><?php echo $user_details['name']; ?></td>
                                        <td><?php echo date('j F, Y', strtotime($user_details['appointment_time'])); ?></td>
                                        <td><?php echo date('j F, Y', strtotime($user_details['date'])); ?></td>
                                        <td><?php echo ($user_details['cost']*.9); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                <!-- Display total earning row -->
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total Earning:</strong></td>
                                    <td><?php echo $totalEarning; ?></td>
                                </tr>
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

<!-- Dark mode toggle button -->
<div style="position: fixed; top: 20px; right: 20px;">
    <button id="darkModeToggle" class="btn btn-secondary">Dark Mode</button>
    <!-- <div class="mt-2"> -->
        <!-- <a href="index.php" class="btn btn-primary d-block mb-2">Home</a>
        <a href="search.php" class="btn btn-success d-block">Search</a> -->
    <!-- </div> -->
</div>

<script>
    // Dark mode toggle functionality
    document.getElementById('darkModeToggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
</script>
</body>
</html>
