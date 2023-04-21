<?php

class UserDao {

    private $conn;
    private $host = 'localhost';
    private $database = 'lab3_db';
    private $username = 'root';
    private $password = 'root';
    
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getUsers() {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function addUser($user) {
        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $age = $user['age'];
        $stmt = $this->conn->prepare("INSERT INTO users (firstName, lastName, age) VALUES (:firstName, :lastName, :age)");
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':age', $age);
        $stmt->execute();
        $user['id'] = $this->conn->lastInsertId();
        return $user;
    }

    function updateUser($user) {
        $id = $user['id'];
        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $age = $user['age'];
        $stmt = $this->conn->prepare("UPDATE users SET firstName = :firstName, lastName = :lastName, age = :age WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':age', $age);
        $stmt->execute();
        echo "User updated successfully <br>";
    }

    function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "User deleted successfully <br>";
    }

}

?>