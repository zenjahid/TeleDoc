<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - TeleDoc</title>
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
                <h1>Contact TeleDoc</h1>
                <p>If you have any questions or need assistance, feel free to contact us using the information below:</p>
                <p>Email: info@teledoc.com</p>
                <p>Phone: +1 (123) 456-7890</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
