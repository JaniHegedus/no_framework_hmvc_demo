<?php
require_once 'system/core/Model.php';
require_once 'system/libraries/Database.php';

class UserModel extends Model
{
    public ?int $userid = null;
    public string $username = "";

    public function addNewUser($id, $username)
    {
        $this->userid = $id;
        $this->username = $username;
    }

    public function getUserId(): int
    {
        return $this->userid;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    public function getUsers(): array
    {
        $conn = Database::getInstance()->getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "\n");
        }

        $query = "SELECT * FROM users;";
        $result = mysqli_query($conn, $query);
        $users = [];

        if ($result && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }

        $conn->close();
        return $users;
    }
}
