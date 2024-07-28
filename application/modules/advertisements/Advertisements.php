<?php
require_once 'controllers/AdvertisementsController.php';
require_once 'models/AdvertisementsModel.php';

require 'Database.php';

class Advertisement
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function createAdvertisement($id, $userId, $title)
    {
        $sql = "INSERT INTO advertisements (id, userid, title) VALUES ($id, $userId, '$title')";
        if ($this->connection->query($sql) === TRUE) {
            echo "New record created successfully\n";
        } else {
            echo "Error: " . $sql . "\n" . $this->connection->error . "\n";
        }
    }

    public function getAdvertisements()
    {
        $sql = "SELECT * FROM advertisements";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Id: " . $row["id"] . " - UserId: " . $row["userid"] . " - Title: " . $row["title"] . "\n";
            }
        } else {
            echo "0 results\n";
        }
    }

    public function updateAdvertisementByUserId($userId, $title)
    {
        $sql = "UPDATE advertisements SET title='$title' WHERE userid=$userId";
        if ($this->connection->query($sql) === TRUE) {
            echo "Record updated successfully\n";
        } else {
            echo "Error updating record: " . $this->connection->error . "\n";
        }
    }

    public function deleteAdvertisementById($id)
    {
        $sql = "DELETE FROM advertisements WHERE id=$id";
        if ($this->connection->query($sql) === TRUE) {
            echo "Record deleted successfully\n";
        } else {
            echo "Error deleting record: " . $this->connection->error . "\n";
        }
    }
}
