<?php

require "application/config/config.php";

class Migration {
    private $connection;

    public function __construct() {
        global $config;
        $this->connection = new mysqli(
            $config['db']['host'],
            $config['db']['username'],
            $config['db']['password'],
            $config['db']['database']
        );

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function isInstalled() {
        if (function_exists('mysqli_connect')) {
            #echo "mysqli is installed!\n";
        } else {
            echo "Enable Mysqli support in your PHP installation\n";
        }
    }

    public function createMigrationsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($this->connection->query($sql) === TRUE) {
            #echo "Table Migrations created successfully\n";
        } else {
            die("Error creating table: " . $this->connection->error . "\n");
        }
    }

    public function hasMigrationRun($migration) {
        $stmt = $this->connection->prepare("SELECT COUNT(*) as count FROM migrations WHERE migration = ?");
        $stmt->bind_param('s', $migration);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['count'] > 0;
    }

    public function logMigration($migration) {
        $stmt = $this->connection->prepare("INSERT INTO migrations (migration) VALUES (?)");
        $stmt->bind_param('s', $migration);
        $stmt->execute();
        $stmt->close();
    }

    public function createUserTable() {
        $migration = "createUserTable";
        if ($this->hasMigrationRun($migration)) {
            return;
        }

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL
        )";

        if ($this->connection->query($sql) === TRUE) {
            echo "Table Users created successfully\n";
            $this->logMigration($migration);
        } else {
            die("Error creating table: " . $this->connection->error . "\n");
        }
    }

    public function createAdvertisementsTable() {
        $migration = "createAdvertisementsTable";
        if ($this->hasMigrationRun($migration)) {
            return;
        }

        $sql = "CREATE TABLE IF NOT EXISTS advertisements (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            userid INT(6) UNSIGNED NOT NULL,
            title VARCHAR(30) NOT NULL,
            FOREIGN KEY (userid) 
                REFERENCES users(id)
                ON DELETE CASCADE
        )";

        if ($this->connection->query($sql) === TRUE) {
            echo "Table Advertisements created successfully\n";
            $this->logMigration($migration);
        } else {
            die("Error creating table: " . $this->connection->error . "\n");
        }
    }

    public function close() {
        $this->connection->close();
    }
}

// Execute migrations only if they haven't run yet
$migration = new Migration();
$migration->isInstalled();
$migration->createMigrationsTable();
$migration->createUserTable();
$migration->createAdvertisementsTable();
$migration->close();
