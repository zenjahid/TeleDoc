<?php
session_start();
?>

<!-- TODO #3 add autologin to profile upon registration @PrashantaSarker -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TeleDoc</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .container {
            margin-top: 30px;
        }

        h2 {
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
    <div class="container">
        <h2>Register</h2>
        <form action="process_register.php" method="post" id="registerForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" class="form-control check_username" id="username" name="username">
                <div id="UserValidity"><small class="error_username" ></small></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input required type="email" class="form-control check_email" id="email" name="email">  
                <div id="emailValidity"><small class="error_mail" ></small></div> <!-- Display email validity message here -->
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input required type="password" class="form-control" id="password" name="password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordVisibility"><i class="bi bi-eye"></i></button>
                    </div>
                </div>
                <div id="passwordRequirements">
                    <ul>
                        <li id="charLength">At least 6 characters</li>
                        <li id="upperCase">At least one uppercase letter</li>
                        <li id="number">At least one number</li>
                        <li id="specialChar">At least one special character</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input required type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                <div id="passwordMatch"></div>
            </div>
            <button type="submit" class="btn btn-primary" id="registerBtn" name="signup">Register</button>
        </form>
        <p>Already Registered! <a href="login.php">Log In Here!</a></p>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="scripts/mail.js"></script>
    <script src="scripts/register.js"></script>
</body>
</html>
