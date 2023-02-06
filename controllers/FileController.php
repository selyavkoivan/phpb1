<?php

use services\FileService;

require_once __DIR__ . "/../models/services/FileService.php";

class FileController
{
    private FileService $fileService;

    public function __construct()
    {
        $this->fileService = new FileService();
    }

    public function executeRequest(): void
    {
        if ($_FILES) {
            if($this->fileService->isUser($_FILES['file']['tmp_name'][0]) &&
                $this->fileService->isDepartment($_FILES['file']['tmp_name'][1])) {
                $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name'][1], $_FILES['file']['name'][1]);
                $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name'][0], $_FILES['file']['name'][0]);
            } else if($this->fileService->isUser($_FILES['file']['tmp_name'][1]) &&
                $this->fileService->isDepartment($_FILES['file']['tmp_name'][0])) {
                $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name'][0], $_FILES['file']['name'][0]);
                $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name'][1], $_FILES['file']['name'][1]);
            }
        }
        $files = $this->fileService->getAllFiles();
        include_once __DIR__ . "/../views/home.php";

    }
}