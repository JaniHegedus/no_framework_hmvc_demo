<?php
require_once 'system/core/Model.php';

class AdvertisementsModel extends Model {
    private int $id;
    private string $title;

    public function addNewAdvertisement($id, $userid, $title): string {
        if ($userid != null) {
            $this->userid = $userid;
            $this->id = $id;
            $this->title = $title;
        } else {
            return "Already added!\n";
        }
        return "";
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }
    public function getAdvertisements(): array
    {
        $conn = Database::getInstance()->getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error . "\n");
        }

        $query = "SELECT id, userid, title FROM advertisements;";
        $result = mysqli_query($conn, $query);
        $advertisements = [];

        if ($result && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $advertisements[] = $row;
            }
        }

        $conn->close();
        return $advertisements;
    }
}
