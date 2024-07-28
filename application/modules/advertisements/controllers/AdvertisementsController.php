<?php
require_once "system/core/Controller.php";
require_once 'application/modules/advertisements/models/AdvertisementsModel.php';
require_once 'system/libraries/Database.php';

class AdvertisementsController extends Controller
{
    private $db;

    public function __construct($module = '') {
        parent::__construct($module);
        $this->db = Database::getInstance()->getConnection();
    }

    public function index() {
        $this->loadModel('AdvertisementsModel');
        $data['advertisements'] = $this->AdvertisementsModel->getAdvertisements(); // Fetch data from users table
        $this->loadView('advertisements/index', $data);
    }

    public function create()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create']))
        {
            if (empty($_POST["userid"])||empty($_POST["title"]))
            {
                $_SESSION['alert_message'] = "You did not fill out the required fields.";
            }
            else
            {
                $id = $_POST["id"] ?: 0;
                $userid = $_POST["userid"];
                $title = $_POST["title"];
                $sql = "INSERT INTO Advertisements (id, userid, title) VALUES ($id, '$userid', '$title')";
                if ($this->db->query($sql) === TRUE) {
                    $_SESSION['alert_message'] = "Record Created! If not check console for errors!";
                } else {
                    $_SESSION['alert_message'] = "Error: " . $this->db->error;
                }
            }
        }
        $this->index();
    }
    public function delete()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']))
        {
            if (empty($_POST["remid"]))
            {
                $_SESSION['alert_message'] = "Id is not given!";
            }
            else
            {
                $id = $_POST["remid"];
                $sql = "DELETE FROM Advertisements WHERE id=$id";
                if ($this->db->query($sql) === TRUE) {
                    $_SESSION['alert_message'] = "Record Deleted";
                } else {
                    $_SESSION['alert_message'] = "Error: " . $this->db->error;
                }
            }
        }
        $this->index();
    }
}
