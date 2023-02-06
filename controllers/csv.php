<?php

require_once __DIR__ . "/FileController.php";
require_once __DIR__ . "/../models/config.php";

$fileController = new FileController();

// получаем файл по айди
$file = $fileController->getFile();

if ($file->isUser()) {
    // получаем всех пользователей в этом файле
    $users = $fileController->getUsers();
    // загружаем их в файл и возвращаем клиенту
    arrayToCsvDownload($users, $GLOBALS['user'], $file->getFileName());
} else {
    $departments = $fileController->getDepartments();
    arrayToCsvDownload($departments, $GLOBALS['department'], $file->getFileName());
}

function arrayToCsvDownload($array, $header, $filename = "export.csv", $delimiter = ";"): void
{

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    $f = fopen('php://output', 'w');

    fputcsv($f, $header, $delimiter);
    foreach ($array as $line) {
        fputcsv($f, (array)$line, $delimiter);
    }
    fclose($f);
}