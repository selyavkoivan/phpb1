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

    public function getFile(): object {
        return $this->fileService->getFile($_GET["id"]);
    }

    public function getDepartments(): array {
        return $this->fileService->getDepartmentsByFile($_GET["id"]);
    }

    public function getUsers(): array {
        return $this->fileService->getUsersByFile($_GET["id"]);
    }
}