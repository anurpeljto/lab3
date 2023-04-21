<?php

class UserDao {
    private $conn;
    private $username = 'root';
    private $host = 'localhost';
    private $password = 'root';
    private $database = 'lab3_db';

    public function __construct(){
        try {
            $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $conn ->setAttribute(PDO::AFTER_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        }
        catch(PDOException $exc){
            echo "Connection failed: " . $exc->getMessage();
        }
    
}
}
?>