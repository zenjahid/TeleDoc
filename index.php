<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<body>
<?php 
require("background.php");
?>
    <h1>TeleDoc</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contract</a></li>
            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="logout.php" class="large-button">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
            <?php else: ?>
                <li><a href="register.php" class="large-button">Register</a></li>
                <li><a href="login.php" class="large-button">Log In</a></li>
            <?php endif; ?>
        </ul>
    </nav>  
</body>  
</html>      