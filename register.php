<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TeleDoc</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 400px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        /* Adjust the width of the input fields */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        .btn {
            width: 100%;
        }
        #passwordRequirements {
            margin-top: 5px;
            margin-bottom: 15px;
        }
        #passwordRequirements ul {
            padding-left: 20px;
        }
        #passwordRequirements li {
            margin-bottom: 5px;
            list-style: none;
        }
        #passwordMatch, #emailValidity {
            margin-top: 5px;
            font-size: 0.9em;
        }
        .input-group {
            position: relative;
        }
        .input-group-append {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            z-index: 99;
        }
        .input-group-append button {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .register-btn-disabled {
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php require('navbar.php') ?>

    <div class="container">
        <h2>Register</h2>
        <form action="process_register.php" method="post" id="registerForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input required type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input required type="email" class="form-control" id="email" name="email">
                <div id="emailValidity"></div>
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const passwordRequirements = document.getElementById('passwordRequirements');
            const charLength = document.getElementById('charLength');
            const upperCase = document.getElementById('upperCase');
            const number = document.getElementById('number');
            const specialChar = document.getElementById('specialChar');
            const passwordMatch = document.getElementById('passwordMatch');
            const emailValidity = document.getElementById('emailValidity');
            const registerBtn = document.getElementById('registerBtn');

            // Function to check password requirements
            function checkPasswordRequirements() {
                const password = passwordInput.value;
                let isValid = true;

                // Check for password length
                if (password.length >= 6) {
                    charLength.classList.add('text-success');
                    charLength.classList.remove('text-danger');
                } else {
                    charLength.classList.remove('text-success');
                    charLength.classList.add('text-danger');
                    isValid = false;
                }

                // Check for uppercase letter
                if (/[A-Z]/.test(password)) {
                    upperCase.classList.add('text-success');
                    upperCase.classList.remove('text-danger');
                } else {
                    upperCase.classList.remove('text-success');
                    upperCase.classList.add('text-danger');
                    isValid = false;
                }

                // Check for number
                if (/\d/.test(password)) {
                    number.classList.add('text-success');
                    number.classList.remove('text-danger');
                } else {
                    number.classList.remove('text-success');
                    number.classList.add('text-danger');
                    isValid = false;
                }

                // Check for special character
                if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
                    specialChar.classList.add('text-success');
                    specialChar.classList.remove('text-danger');
                } else {
                    specialChar.classList.remove('text-success');
                    specialChar.classList.add('text-danger');
                    isValid = false;
                }

                return isValid;
            }

            // Function to check password match
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword !== '') {
                    if (password === confirmPassword) {
                        passwordMatch.textContent = 'Passwords match';
                        passwordMatch.classList.add('text-success');
                        passwordMatch.classList.remove('text-danger');
                        return true;
                    } else {
                        passwordMatch.textContent = 'Passwords do not match';
                        passwordMatch.classList.remove('text-success');
                        passwordMatch.classList.add('text-danger');
                        return false;
                    }
                } else {
                    passwordMatch.textContent = ''; // Clear the message if no confirmation password entered
                    return false;
                }
            }

            // Function to check email validity
            function checkEmailValidity(email) {
                // Check if the email format is valid
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    return "Enter a valid email address";
                }

                return "";
            }
// TODO #2 debug check email availability @PrashantaSarker
            // Function to check email availability
            function checkEmailAvailability(email) {
                // Send an AJAX request to check email availability
                //return fetch('check_email.php?email=' + encodeURIComponent(email))
                        // .then(response => response.json())
                        // .then(data => {
                        //     return data.available;
                        // })
                        // .catch(error => {
                        //     console.error('Error checking email availability:', error);
                        //     return false;
                        // });
            }

            // Function to update register button state
            function updateRegisterBtnState() {
                const username = usernameInput.value;
                const email = emailInput.value;
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                const isUsernameValid = username.trim() !== '';
                const emailValidityMessage = checkEmailValidity(email);
                
                // Check email availability
                checkEmailAvailability(email).then(isEmailAvailable => {
                    const emailAvailabilityMessage = isEmailAvailable ? "" : "Email is already taken";
                    const isEmailValid = emailValidityMessage === "" && isEmailAvailable;
                    const isPasswordValid = checkPasswordRequirements() && checkPasswordMatch();
                
                    if (isUsernameValid && isEmailValid && isPasswordValid) {
                        registerBtn.classList.remove('register-btn-disabled');
                        registerBtn.removeAttribute('disabled');
                    } else {
                        registerBtn.classList.add('register-btn-disabled');
                        registerBtn.setAttribute('disabled', 'disabled');
                    }
                
                    // Update email validity message under the input
                    emailValidity.textContent = emailValidityMessage || emailAvailabilityMessage;
                    emailValidity.classList.toggle('text-success', emailValidityMessage === "");
                    emailValidity.classList.toggle('text-danger', emailValidityMessage !== "" || !isEmailAvailable);
                });
            }

            // Event listeners
            usernameInput.addEventListener('input', updateRegisterBtnState);
            emailInput.addEventListener('input', updateRegisterBtnState);
            passwordInput.addEventListener('input', function() {
                checkPasswordRequirements();
                checkPasswordMatch();
                updateRegisterBtnState();
            });
            confirmPasswordInput.addEventListener('input', function() {
                checkPasswordMatch();
                updateRegisterBtnState();
            });
            registerForm.addEventListener('submit', function(event) {
                event.preventDefault();
                // Perform form submission here if needed
                registerForm.submit();
            });
            document.getElementById('togglePasswordVisibility').addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
            });
        });
    </script>
</body>
</html>
