<?php
class Teledoc {
    public static function connect() {
        try {
            $db_name = "teledoc";
            $localhost = "localhost";
            $username = "root";
            $password = "";
            // $port = 3307; // 
            $port = 3308; // comment this for normal useage and uncomment the above line 

            $con = new PDO("mysql:host=$localhost;dbname=$db_name;port=$port", $username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con; // Return the PDO connection object
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null; 
        }
    }
}
?>
