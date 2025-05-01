<?php
require_once 'views/template.php';

$content = '
<div class="row mb-3">
    <div class="col">
        <h2>Courses List</h2>
    </div>
    <div class="col-auto">
        <a href="index.php?controller=course&action=create" class="btn btn-primary">Add New Course</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Credits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

foreach ($courses as $course) {
    $content .= '
            <tr>
                <td>' . $course->getId() . '</td>
                <td>' . $course->getCourseCode() . '</td>
                <td>' . $course->getCourseName() . '</td>
                <td>' . $course->getCredits() . '</td>
                <td>
                    <a href="index.php?controller=course&action=students&id=' . $course->getId() . '" class="btn btn-info btn-sm">Students</a>
                    <a href="index.php?controller=course&action=edit&id=' . $course->getId() . '" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?controller=course&action=delete&id=' . $course->getId() . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this course?\')">Delete</a>
                </td>
            </tr>';
}

$content .= '
        </tbody>
    </table>
</div>';

$template = new Template('templates/index.html');
$template->set('page_title', 'Courses List');
$template->set('content', $content);
echo $template->render();