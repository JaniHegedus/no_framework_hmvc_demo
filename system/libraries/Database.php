<?php

class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;
    private static $instance = null;

    public function __construct() {
        global $config;
        $this->host = $config['db']['host'];
        $this->username = $config['db']['username'];
        $this->password = $config['db']['password'];
        $this->database = $config['db']['database'];
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method to get the database connection
    public function getConnection() {
        return $this->connection;
    }
    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function close() {
        $this->connection->close();
    }
}
