<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TeleDoc - Your Health, Our Priority</title>
    <link rel="stylesheet" href="design.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for hover effect */
        .navbar-nav li a:hover {
            color: #fff !important;
            background-color: #0d6efd !important;
        }
        /* Additional styling for index.php */
        .jumbotron {
            background-color: #f8f9fa;
            padding: 80px 20px;
            margin-top: 30px;
            border-radius: 15px;
        }
        .jumbotron h1 {
            font-weight: bold;
            color: #0d6efd;
        }
        .jumbotron p {
            color: #495057;
        }
    </style>
</head>
<body>
    <!-- Include the navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Main content -->
    <div class="container">
        <div class="jumbotron text-center">
            <h1>Welcome to TeleDoc</h1>
            <p>Your Health, Our Priority</p>
            <p>Get access to healthcare services from the comfort of your home.</p>
            <a class="btn btn-primary" href="register.php">Register Now</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
