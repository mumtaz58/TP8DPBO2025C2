<?php
class DB {
    private static $instance = NULL;
    private $mysqli;

    private function __construct() {
        $this->mysqli = new mysqli('localhost', 'root', '', 'db_mvc');
        if ($this->mysqli->connect_error) {
            die('Connection failed: ' . $this->mysqli->connect_error);
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function query($sql) {
        return $this->mysqli->query($sql);
    }

    public function escape_string($string) {
        return $this->mysqli->real_escape_string($string);
    }

    public function get_last_id() {
        return $this->mysqli->insert_id;
    }
}