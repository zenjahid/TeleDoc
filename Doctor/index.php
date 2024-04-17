<?php
                session_start();
                require_once('../connection.php');

                $error_message = '';

                if(isset($_POST['login'])){
                    $_SESSION['validate'] = false;
                    $username = $_POST['email'];
                    $password = $_POST['password'];

                    $p = teledoc::connect()->prepare('SELECT * FROM doctor WHERE email=:u');
                    $p->bindValue(':u', $username);
                    $p->execute();
                    $user = $p->fetch(PDO::FETCH_ASSOC);
                    
                    if ($user) {
                        $storedPassword = $user['Password'];
                        
                        if ($password === $storedPassword) {
                            $_SESSION['username'] = $username;
                            $_SESSION['user_id']=$user['IndexNumber'];
                            $_SESSION['validate'] = true;
                            echo '<script>alert("You have been logged in!");</script>';
                            header('location:profile.php');
                            exit;
                        } else {  
                            $error_message = "Password mismatch!";
                        }
                    } else {
                        $error_message = "User not found!";
                    }
                }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TeleDoc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('path/to/your/image.jpg'); /* Replace 'path/to/your/image.jpg' with the path to your image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 400px;
            margin: auto;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Doctor Login | TeleDoc</h3>
            </div>
            <div class="card-body">
                <!-- Your PHP code for the form goes here -->
                
                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input required type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input required type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100" value="login_button" name="login">Login</button>
                </form>
                <p class="text-center mt-3">Don't have an account? Contact Admin</p>
            </div>
        </div>
    </div>
</body>
</html>
