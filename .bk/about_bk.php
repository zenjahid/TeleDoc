<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - TeleDoc</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Styles remain unchanged from your original code */
    </style>
</head>
<body>
    <?php require('navbar.php'); ?> <!-- Include the navbar here -->

    <!-- Main Content -->
    <div class="container mt-5 main-content">
        <h2>About TeleDoc</h2>
        <p>TeleDoc is a revolutionary platform that allows users to easily find and book appointments with doctors online. Here's how it works:</p>
        
        <h3>1. Search for Doctors</h3>
        <p>Users can search for doctors based on various criteria such as specialization, location, availability, and more. Our advanced search functionality ensures that users can find the right doctor to meet their specific needs.</p>

        <h3>2. View Doctor Profiles</h3>
        <p>Once users find a doctor they're interested in, they can view the doctor's profile to learn more about their qualifications, experience, areas of expertise, and patient reviews. This helps users make informed decisions when selecting a doctor.</p>

        <h3>3. Book Appointments</h3>
        <p>After selecting a doctor, users can easily book appointments directly through the TeleDoc platform. Our intuitive booking system allows users to choose convenient appointment times and provide any necessary details.</p>

        <h3>4. Manage Appointments</h3>
        <p>TeleDoc also provides users with the ability to manage their appointments effortlessly. Users can view upcoming appointments, reschedule or cancel appointments if needed, and receive reminders to ensure they never miss an appointment.</p>

        <h3>5. Access Telehealth Services</h3>
        <p>In addition to booking in-person appointments, TeleDoc also offers telehealth services, allowing users to consult with doctors remotely via video or phone calls. This provides users with convenient access to healthcare from the comfort of their own homes.</p>

        <p>With TeleDoc, we aim to make healthcare more accessible and convenient for everyone, empowering users to take control of their health and well-being.</p>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
