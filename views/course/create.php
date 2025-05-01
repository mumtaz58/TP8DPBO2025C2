<?php
require_once 'views/template.php';

$content = '
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="text-center">Create New Course</h3>
    </div>
    <div class="card-body">
        <form method="post" action="index.php?controller=course&action=create">
            <div class="mb-3">
                <label for="course_code" class="form-label">Course Code:</label>
                <input type="text" class="form-control" id="course_code" name="course_code" required>
            </div>
            <div class="mb-3">
                <label for="course_name" class="form-label">Course Name:</label>
                <input type="text" class="form-control" id="course_name" name="course_name" required>
            </div>
            <div class="mb-3">
                <label for="credits" class="form-label">Credits:</label>
                <input type="number" class="form-control" id="credits" name="credits" min="1" max="6" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="index.php?controller=course&action=index" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>';

$template = new Template('templates/index.html');
$template->set('page_title', 'Create Course');
$template->set('content', $content);
echo $template->render();