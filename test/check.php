<?php
// Database connection
require 'config.php';
extract($_POST);
if(isset($check_email)) {
    $email = $check_email;

    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM info WHERE email = '$email'");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            echo json_encode(array("available" => false));
        } else {
            echo json_encode(array("available" => true));
        }
    } else {
        echo json_encode(array("error" => "Database query error"));
    }
}
?>
