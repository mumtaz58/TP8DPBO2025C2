<?php
require_once 'views/template.php';

$content = '
<div class="row mb-3">
    <div class="col">
        <h2>Students in Course: ' . $course->getCourseName() . ' (' . $course->getCourseCode() . ')</h2>
    </div>
    <div class="col-auto">
        <a href="index.php?controller=course&action=index" class="btn btn-secondary">Back to Courses</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <h4>Enroll Student</h4>
    </div>
    <div class="card-body">
        <form method="post" action="index.php?controller=course&action=students&id=' . $course->getId() . '" class="row g-3">
            <div class="col-md-5">
                <select name="student_id" class="form-select" required>
                    <option value="">-- Select Student --</option>';

// Get already enrolled student IDs
$enrolled_ids = array_map(function($student) {
    return $student->getId();
}, $students);

foreach ($all_students as $student) {
    // Only show students not already enrolled
    if (!in_array($student->getId(), $enrolled_ids)) {
        $content .= '<option value="' . $student->getId() . '">' . $student->getName() . ' (' . $student->getNim() . ')</option>';
    }
}

$content .= '
                </select>
            </div>
            <div class="col-md-4">
                <select name="semester" class="form-select" required>
                    <option value="">-- Select Semester --</option>
                    <option value="Fall 2024">Fall 2024</option>
                    <option value="Spring 2025">Spring 2025</option>
                    <option value="Summer 2025">Summer 2025</option>
                    <option value="Fall 2025">Fall 2025</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" name="enroll" class="btn btn-primary">Enroll Student</button>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIM</th>
                <th>Phone</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

if (count($students) > 0) {
    foreach ($students as $student) {
        $content .= '
                <tr>
                    <td>' . $student->getId() . '</td>
                    <td>' . $student->getName() . '</td>
                    <td>' . $student->getNim() . '</td>
                    <td>' . $student->getPhone() . '</td>
                    <td>' . $student->getJoinDate() . '</td>
                    <td>
                        <form method="post" action="index.php?controller=course&action=students&id=' . $course->getId() . '">
                            <input type="hidden" name="student_id" value="' . $student->getId() . '">
                            <button type="submit" name="remove" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to remove this student from the course?\')">Remove</button>
                        </form>
                    </td>
                </tr>';
    }
} else {
    $content .= '
                <tr>
                    <td colspan="6" class="text-center">No students enrolled in this course yet.</td>
                </tr>';
}

$content .= '
        </tbody>
    </table>
</div>';

$template = new Template('templates/index.html');
$template->set('page_title', 'Course Students');
$template->set('content', $content);
echo $template->render();