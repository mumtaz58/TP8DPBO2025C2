<?php
include_once 'models/Student.class.php';

class StudentController {
    public function index() {
        $students = Student::getAll();
        
        require_once 'views/student/index.php';
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $nim = $_POST['nim'];
            $phone = $_POST['phone'];
            $join_date = $_POST['join_date'];
            
            $student = new Student('', $name, $nim, $phone, $join_date);
            $student->save();
            
            header('Location: index.php?controller=student&action=index');
            exit;
        }
        
        require_once 'views/student/create.php';
    }
    
    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=student&action=index');
            exit;
        }
        
        $id = $_GET['id'];
        $student = Student::getById($id);
        
        if (!$student) {
            header('Location: index.php?controller=student&action=index');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student->setName($_POST['name']);
            $student->setNim($_POST['nim']);
            $student->setPhone($_POST['phone']);
            $student->setJoinDate($_POST['join_date']);
            
            $student->save();
            
            header('Location: index.php?controller=student&action=index');
            exit;
        }
        
        require_once 'views/student/edit.php';
    }
    
    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?controller=student&action=index');
            exit;
        }
        
        $id = $_GET['id'];
        Student::delete($id);
        
        header('Location: index.php?controller=student&action=index');
        exit;
    }
}