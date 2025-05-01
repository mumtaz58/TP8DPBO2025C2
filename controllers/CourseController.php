<?php
include_once 'models/Course.class.php';
include_once 'models/Student.class.php';

class CourseController {
    public function index() {
        $courses = Course::getAll();
        
        require_once 'views/course/index.php';
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_code = $_POST['course_code'];
            $course_name = $_POST['course_name'];
            $credits = $_POST['credits'];
            
            $course = new Course('', $course_code, $course_name, $credits);
            $course->save();
            
            header('Location: index.php?controller=course&action=index');
            exit;
        }
        
        require_once 'views/course/create.php';
    }
    
    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=course&action=index');
            exit;
        }
        
        $id = $_GET['id'];
        $course = Course::getById($id);
        
        if (!$course) {
            header('Location: index.php?controller=course&action=index');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course->setCourseCode($_POST['course_code']);
            $course->setCourseName($_POST['course_name']);
            $course->setCredits($_POST['credits']);
            
            $course->save();
            
            header('Location: index.php?controller=course&action=index');
            exit;
        }
        
        require_once 'views/course/edit.php';
    }
    
    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=course&action=index');
            exit;
        }
        
        $id = $_GET['id'];
        Course::delete($id);
        
        header('Location: index.php?controller=course&action=index');
        exit;
    }
    
    public function students() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=course&action=index');
            exit;
        }
        
        $id = $_GET['id'];
        $course = Course::getById($id);
        
        if (!$course) {
            header('Location: index.php?controller=course&action=index');
            exit;
        }
        
        $students = $course->getStudents();
        $all_students = Student::getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['enroll']) && isset($_POST['student_id'])) {
                $course->enrollStudent($_POST['student_id'], $_POST['semester']);
            } else if (isset($_POST['remove']) && isset($_POST['student_id'])) {
                $course->removeStudent($_POST['student_id']);
            }
            
            header('Location: index.php?controller=course&action=students&id=' . $id);
            exit;
        }
        
        require_once 'views/course/students.php';
    }
}