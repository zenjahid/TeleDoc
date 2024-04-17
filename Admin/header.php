<?php
    $count="SELECT COUNT(*) as doctor_count FROM doctor;";
    $countqry = $conn->prepare($count);
    $countqry->execute();
    $count_arr = $countqry->fetchAll(PDO::FETCH_ASSOC);
    // print_r($count_arr);
    $docnumber=$count_arr[0]['doctor_count'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        .card {
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #8ecae6; /* Changed to light blue */
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: none;
            border-radius: 0 0 10px 10px;
        }

        .btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: bold;
        }

        /* Dark mode */
        body.dark-mode {
            background-color: #343a40; /* Dark background color */
            color: #fff; /* Light text color */
        }

        .dark-mode .card-header {
            background-color: #212529; /* Dark header background color */
        }

        .dark-mode .card-footer {
            background-color: #343a40; /* Dark footer background color */
        }
    </style>
</head>
<body>