<?php
class Teledoc {
    public static function connect() {
        try {  
            $con = new PDO('mysql:host=localhost;dbname=teledoc', 'root', '');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con; // Return the PDO connection object
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return null; 
        }
    }
}
?>
