<?php
class Course {
    private $id;
    private $course_code;
    private $course_name;
    private $credits;

    public function __construct($id = '', $course_code = '', $course_name = '', $credits = '') {
        $this->id = $id;
        $this->course_code = $course_code;
        $this->course_name = $course_name;
        $this->credits = $credits;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getCourseCode() {
        return $this->course_code;
    }

    public function getCourseName() {
        return $this->course_name;
    }

    public function getCredits() {
        return $this->credits;
    }

    // Setters
    public function setCourseCode($course_code) {
        $this->course_code = $course_code;
    }

    public function setCourseName($course_name) {
        $this->course_name = $course_name;
    }

    public function setCredits($credits) {
        $this->credits = $credits;
    }

    // Database operations
    public static function getAll() {
        $db = DB::getInstance();
        $sql = "SELECT * FROM courses";
        $result = $db->query($sql);
        
        $courses = array();
        while ($row = $result->fetch_assoc()) {
            $courses[] = new Course(
                $row['id'],
                $row['course_code'],
                $row['course_name'],
                $row['credits']
            );
        }
        
        return $courses;
    }

    public static function getById($id) {
        $db = DB::getInstance();
        $sql = "SELECT * FROM courses WHERE id = " . $db->escape_string($id);
        $result = $db->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Course(
                $row['id'],
                $row['course_code'],
                $row['course_name'],
                $row['credits']
            );
        }
        
        return null;
    }

    public function save() {
        $db = DB::getInstance();
        
        if ($this->id == '') {
            // Insert new record
            $sql = "INSERT INTO courses (course_code, course_name, credits) 
                    VALUES ('" . 
                    $db->escape_string($this->course_code) . "', '" . 
                    $db->escape_string($this->course_name) . "', '" . 
                    $db->escape_string($this->credits) . "')";
            $db->query($sql);
            $this->id = $db->get_last_id();
        } else {
            // Update existing record
            $sql = "UPDATE courses SET 
                    course_code = '" . $db->escape_string($this->course_code) . "',
                    course_name = '" . $db->escape_string($this->course_name) . "',
                    credits = '" . $db->escape_string($this->credits) . "'
                    WHERE id = " . $db->escape_string($this->id);
            $db->query($sql);
        }
        
        return true;
    }

    public static function delete($id) {
        $db = DB::getInstance();
        $sql = "DELETE FROM courses WHERE id = " . $db->escape_string($id);
        return $db->query($sql);
    }

    // Get students enrolled in this course
    public function getStudents() {
        $db = DB::getInstance();
        $sql = "SELECT s.* FROM students s
                JOIN student_courses sc ON s.id = sc.student_id
                WHERE sc.course_id = " . $db->escape_string($this->id);
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

    // Enroll a student in this course
    public function enrollStudent($student_id, $semester) {
        $db = DB::getInstance();
        $sql = "INSERT INTO student_courses (student_id, course_id, semester)
                VALUES (" . 
                $db->escape_string($student_id) . ", " . 
                $db->escape_string($this->id) . ", '" . 
                $db->escape_string($semester) . "')";
        return $db->query($sql);
    }

    // Remove a student from this course
    public function removeStudent($student_id) {
        $db = DB::getInstance();
        $sql = "DELETE FROM student_courses 
                WHERE student_id = " . $db->escape_string($student_id) . " 
                AND course_id = " . $db->escape_string($this->id);
        return $db->query($sql);
    }
}