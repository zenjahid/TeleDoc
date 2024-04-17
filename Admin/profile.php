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

    // Fetch appointment details
    $qr = "SELECT d.Name AS doctor_name, da.appointment_time, da.date, da.cost, u.name AS user_name
    FROM doctor_availablity da 
    JOIN doctor d ON d.IndexNumber = da.doc_id
    JOIN info u ON u.id = da.user_id;";
    $qry = $conn->prepare($qr);
    $qry->execute();
    $table = $qry->fetchAll(PDO::FETCH_ASSOC);



    // Calculate total earning
    $totalEarning = 0;
    foreach ($table as $appointment) {
        $totalEarning += $appointment['cost'] * 0.1;
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
                    <h3>Admin | Profile</h3>
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Appointment Time</th>
                                    <th>Date</th>
                                    <th>User Name</th>
                                    <th>Cost</th>
                                    <th>Profit</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($table as $appointment): ?>
                                    <tr>
                                        <td><?php echo $appointment['doctor_name']; ?></td>
                                        <td><?php echo date('j F, Y', strtotime($appointment['appointment_time'])); ?></td>
                                        <td><?php echo date('j F, Y', strtotime($appointment['date'])); ?></td>
                                        <td><?php echo $appointment['user_name']; ?></td>
                                        <td><?php echo ($appointment['cost']*1); ?></td>
                                        <td><?php echo ($appointment['cost']*.1); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="5" class="text-center"><strong>Total Profit:</strong></td>
                                    <td class="text-center"><strong><?php echo $totalEarning; ?></strong></td>
                                    <!-- <td><?php echo $totalEarning; ?></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="admin_logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dark mode toggle button -->
<?php require("footer.php"); ?>
