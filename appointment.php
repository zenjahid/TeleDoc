<?php
require_once('./connection.php');


$doctorId = $_GET['IndexNumber'];

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
    <title>Book Appointment with Dr. <?php echo $doctor['Name']; ?></title>
</head>

<body>

    <h1>Dr. <?php echo $doctor['Name']; ?></h1>

    <ul>
        <li><?php echo $doctor['Name']; ?></li>
        <li><?php echo $doctor['Email']; ?></li>
        <li><?php echo $doctor['Degree']; ?></li>
        <li><?php echo $doctor['Speciality']; ?></li>
        <li><?php echo $doctor['Division']; ?></li>
        <li><?php echo $doctor['ChamberNumber']; ?></li>
        <li><?php echo $doctor['Hospital']; ?></li>
        <li><?php echo $doctor['ChamberLocation']; ?></li>
        <li><?php echo $doctor['VisitCharge']; ?></li>
        <li><?php echo $doctor['TimeStart'] . ' - ' . $doctor['TimeEnd']; ?></li>
        <li><p>Book</p></li>
    </ul>

    <h2>Available Appointment Times</h2>

    <?php

    try {
        $query = "SELECT * FROM doctor_availability WHERE doctor_id = :doctorId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':doctorId', $doctorId);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<p>' . $row['appointment_time'] . '</p>';
        }

    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    ?>

    <form action="book_appointment.php" method="post">
        <input type="hidden" name="doctorId" value="<?php echo $doctorId; ?>">
        <label>Appointment Date:</label>
        <input type="date" name="appointmentDate">
        <label>Appointment Time:</label>
        <select name="appointmentTime">
            <?php
            try {
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option>' . $row['appointment_time'] . '</option>';
                }
            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
            ?>
        </select>
        <input type="submit" value="Book Appointment">
    </form>

</body>

</html>
