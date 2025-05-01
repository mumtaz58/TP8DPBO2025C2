<?php
require_once 'views/template.php';

$content = '
<div class="row mb-3">
    <div class="col">
        <h2>Students List</h2>
    </div>
    <div class="col-auto">
        <a href="index.php?controller=student&action=create" class="btn btn-primary">Add New Student</a>
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

foreach ($students as $student) {
    $content .= '
            <tr>
                <td>' . $student->getId() . '</td>
                <td>' . $student->getName() . '</td>
                <td>' . $student->getNim() . '</td>
                <td>' . $student->getPhone() . '</td>
                <td>' . $student->getJoinDate() . '</td>
                <td>
                    <a href="index.php?controller=student&action=edit&id=' . $student->getId() . '" class="btn btn-warning btn-sm">Edit</a>
                    <a href="index.php?controller=student&action=delete&id=' . $student->getId() . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this student?\')">Delete</a>
                </td>
            </tr>';
}

$content .= '
        </tbody>
    </table>
</div>';

$template = new Template('templates/index.html');
$template->set('page_title', 'Students List');
$template->set('content', $content);
echo $template->render();