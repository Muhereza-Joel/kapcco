<?php
namespace kapcco\core;

use Exception;
use mysqli;

class DatabaseConnection{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;
    private $mysqli;

    public function __construct($host, $dbname, $username, $password, $charset = 'utf8') {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;

        $this->connect();
    }

    private function connect() {

        try {
            $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        } catch (Exception $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function get_connection() {
        return $this->mysqli;
    }
}

?>