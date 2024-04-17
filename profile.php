<?php
require_once('./connection.php');
session_start();

try {
    $conn = Teledoc::connect();

    // Fetch user details
    $query = "SELECT * FROM info WHERE user_type = 2 AND id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
// print_r($user);
    // Fetch appointment details
    $query = "SELECT d.name, da.appointment_time, da.date, da.cost, da.app_id FROM doctor d INNER JOIN doctor_availablity da ON da.doc_id = d.IndexNumber WHERE da.user_id = :user_id";
    $ccstmt = $conn->prepare($query);
    $ccstmt->bindParam(':user_id', $_SESSION['user_id']);
    $ccstmt->execute();

} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

$query = "DELETE from doctor_availablity where app_id = :app_id;";
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
                        <input type="text" readonly class="form-control" id="username" value="<?php echo $user['name']; ?>">
                    </div>
                    <div class="form-group d-flex flex-column">
                        <label for="email" class="font-weight-bold">Email:</label>
                        <input type="email" readonly class="form-control" id="email" value="<?php echo $user['email']; ?>">
                    </div>
                    <!-- Table to display appointment details -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Appointment Time</th>
                                    <th>Date</th>
                                    <th>Cost</th>
                                    <th>Action</th> <!-- New column for action buttons -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($user_details = $ccstmt->fetch(PDO::FETCH_ASSOC)): ?>
                                    <tr>
                                        <td><?php echo $user_details['name']; ?></td>
                                        <td><?php echo date('j F, Y', strtotime($user_details['appointment_time'])); ?></td>
                                        <td><?php echo date('j F, Y', strtotime($user_details['date'])); ?></td>
                                        <td><?php echo $user_details['cost']; ?></td>
                                        <td>
                                            <form method="post" action="profile.php">
                                                <input type="hidden" name="app_id" value="<?php echo $user_details['app_id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete Booking</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dark mode toggle button -->
<div style="position: fixed; top: 20px; right: 20px;">
    <button id="darkModeToggle" class="btn btn-secondary">Dark Mode</button>
    <div class="mt-2">
        <a href="index.php" class="btn btn-primary d-block mb-2">Home</a>
        <a href="search.php" class="btn btn-success d-block">Search</a>
    </div>
</div>

<script>
    // Dark mode toggle functionality
    document.getElementById('darkModeToggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
</script>
</body>
</html>
