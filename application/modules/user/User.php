<?php
require_once 'controllers/UserController.php';
require_once 'models/UserModel.php';

require 'system/libraries/Database.php';

class User {
    private $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function createUser($id, $username) {
        $sql = "INSERT INTO users (id, username) VALUES ($id, '$username')";
        if ($this->connection->query($sql) === TRUE) {
            echo "New record created successfully\n";
        } else {
            echo "Error: " . $sql . "\n" . $this->connection->error . "\n";
        }
    }

    public function getUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "Id: " . $row["id"] . " - UserName: " . $row["username"] . "\n";
            }
        } else {
            echo "0 results\n";
        }
    }

    public function updateUserById($id, $username) {
        $sql = "UPDATE users SET username='$username' WHERE id=$id";
        if ($this->connection->query($sql) === TRUE) {
            echo "Record updated successfully\n";
        } else {
            echo "Error updating record: " . $this->connection->error . "\n";
        }
    }

    public function deleteUserById($id) {
        $sql = "DELETE FROM users WHERE id=$id";
        if ($this->connection->query($sql) === TRUE) {
            echo "Record deleted successfully\n";
        } else {
            echo "Error deleting record: " . $this->connection->error . "\n";
        }
    }
}