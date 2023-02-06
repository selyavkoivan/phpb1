<?php
require_once __DIR__ . "/FileController.php";

$fileController = new FileController();
$file = $fileController->getFile();

if($file->isUser()) {
    $users = $fileController->getUsers();
    require_once __DIR__ . "/../views/userFile.php";
}
else {
    $departments = $fileController->getDepartments();
    require_once __DIR__ . "/../views/departmentFile.php";
}