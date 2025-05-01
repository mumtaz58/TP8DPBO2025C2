<?php
// Set error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include all required models
require_once 'models/DB.class.php';
require_once 'models/Student.class.php';
require_once 'models/Course.class.php';
require_once 'models/Template.class.php';

// Define the default controller and action
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'student';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Load the appropriate controller
$controller_name = ucfirst($controller) . 'Controller';
$controller_file = 'controllers/' . $controller_name . '.php';

if (file_exists($controller_file)) {
    require_once $controller_file;
    
    $controller_instance = new $controller_name();
    
    // Check if the requested action exists
    if (method_exists($controller_instance, $action)) {
        // Call the controller action
        $controller_instance->$action();
    } else {
        // Action not found, show error
        echo "Action not found: " . htmlspecialchars($action);
    }
} else {
    // Controller not found, show error
    echo "Controller not found: " . htmlspecialchars($controller_name);
}