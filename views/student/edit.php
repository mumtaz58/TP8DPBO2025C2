<?php
require_once 'views/template.php';

$content = '
<div class="card">
    <div class="card-header bg-warning text-white">
        <h3 class="text-center">Edit Student</h3>
    </div>
    <div class="card-body">
        <form method="post" action="index.php?controller=student&action=edit&id=' . $student->getId() . '">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="' . $student->getName() . '" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" value="' . $student->getNim() . '" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="' . $student->getPhone() . '" required>
            </div>
            <div class="mb-3">
                <label for="join_date" class="form-label">Join Date:</label>
                <input type="date" class="form-control" id="join_date" name="join_date" value="' . $student->getJoinDate() . '" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="index.php?controller=student&action=index" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>';

$template = new Template('templates/index.html');
$template->set('page_title', 'Edit Student');
$template->set('content', $content);
echo $template->render();