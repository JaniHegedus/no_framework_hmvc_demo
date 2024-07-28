<?php
require_once 'system/core/Controller.php';
require_once 'application/modules/user/models/UserModel.php';
require_once 'system/libraries/Database.php';

class UserController extends Controller
{
    private $db;

    public function __construct($module = '')
    {
        parent::__construct($module);
        $this->db = Database::getInstance()->getConnection();
    }

    public function index()
    {
        $this->loadModel('UserModel');
        $data['users'] = $this->UserModel->getUsers(); // Fetch data from users table
        $this->loadView('user/index', $data);
    }

    public function create()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create']))
        {
            if (empty($_POST["UserName"]))
            {
                $_SESSION['alert_message'] = "You did not fill out the required fields.";
            }
            else
            {
                $id = $_POST["id"] ?: 0;
                $username = $_POST["UserName"];
                $sql = "INSERT INTO users (id, username) VALUES ($id, '$username')";
                if ($this->db->query($sql) === TRUE) {
                    $_SESSION['alert_message'] = "Record Created If not check console for errors!";
                } else {
                    $_SESSION['alert_message'] = "Error: " . $this->db->error;
                }
            }
        }
        $this->index();
    }

    public function delete()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) // Check if delete button was pressed
        {
            if (empty($_POST["remid"]))
            {
                $_SESSION['alert_message'] = "Id is not given!";
            }
            else
            {
                $id = intval($_POST["remid"]); // Ensure ID is an integer
                $sql = "DELETE FROM users WHERE id=$id";

                try {
                    // Execute the deletion query
                    if ($this->db->query($sql) === TRUE) {
                        $_SESSION['alert_message'] = "Record and related records deleted successfully.";
                    } else {
                        $_SESSION['alert_message'] = "Error: " . $this->db->error;
                    }
                } catch (Exception $e) {
                    // Catch general exceptions
                    $_SESSION['alert_message'] = "An unexpected error occurred: " . $e->getMessage();
                }
            }
        }
        header("Location: /no_framework/user/index"); // Redirect after processing
        exit();
    }

}
