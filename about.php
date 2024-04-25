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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/about.css">
    
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
                <h1>About TeleDoc</h1>
                <p>TeleDoc is a platform where you can search for doctors and book appointments with them online.</p>
                <p>With TeleDoc, you can easily find the right doctor for your needs and schedule appointments without
                    hassle.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
