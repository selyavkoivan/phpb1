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
            $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name']);

        }
        include_once __DIR__ . "/../views/home.php";

    }
}