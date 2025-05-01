<?php
class Student {
    private $id;
    private $name;
    private $nim;
    private $phone;
    private $join_date;

    public function __construct($id = '', $name = '', $nim = '', $phone = '', $join_date = '') {
        $this->id = $id;
        $this->name = $name;
        $this->nim = $nim;
        $this->phone = $phone;
        $this->join_date = $join_date;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getNim() {
        return $this->nim;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getJoinDate() {
        return $this->join_date;
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setNim($nim) {
        $this->nim = $nim;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setJoinDate($join_date) {
        $this->join_date = $join_date;
    }

    // Database operations
    public static function getAll() {
        $db = DB::getInstance();
        $sql = "SELECT * FROM students";
        $result = $db->query($sql);
        
        $students = array();
        while ($row = $result->fetch_assoc()) {
            $students[] = new Student(
                $row['id'],
                $row['name'],
                $row['nim'],
                $row['phone'],
                $row['join_date']
            );
        }
        
        return $students;
    }

    public static function getById($id) {
        $db = DB::getInstance();
        $sql = "SELECT * FROM students WHERE id = " . $db->escape_string($id);
        $result = $db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Student(
                $row['id'],
                $row['name'],
                $row['nim'],
                $row['phone'],
                $row['join_date']
            );
        }
        
        return null;
    }

    public function save() {
        $db = DB::getInstance();
        
        if ($this->id == '') {
            // Insert new record
            $sql = "INSERT INTO students (name, nim, phone, join_date) 
                    VALUES ('" . 
                    $db->escape_string($this->name) . "', '" . 
                    $db->escape_string($this->nim) . "', '" . 
                    $db->escape_string($this->phone) . "', '" . 
                    $db->escape_string($this->join_date) . "')";
            $db->query($sql);
            $this->id = $db->get_last_id();
        } else {
            // Update existing record
            $sql = "UPDATE students SET 
                    name = '" . $db->escape_string($this->name) . "',
                    nim = '" . $db->escape_string($this->nim) . "',
                    phone = '" . $db->escape_string($this->phone) . "',
                    join_date = '" . $db->escape_string($this->join_date) . "'
                    WHERE id = " . $db->escape_string($this->id);
            $db->query($sql);
        }
        
        return true;
    }

    public static function delete($id) {
        $db = DB::getInstance();
        $sql = "DELETE FROM students WHERE id = " . $db->escape_string($id);
        return $db->query($sql);
    }
}