<?php

namespace services;

use models\database\DBConnection;
use models\services\parser\FileParser;
use models\services\DBService;
require_once __DIR__ . "/parser/FileParser.php";
require_once __DIR__ . "/DBService.php";
require_once __DIR__ . "/database/DBConnection.php";
class FileService
{
    private FileParser $fileParser;
    private DBService $DBService;

    public function __construct() {
        $this->fileParser = new FileParser();
        $this->DBService = new DBService();
    }

    public function isUser(string $tmpName): bool {
        $csvFile = file($tmpName);
        return $this->fileParser->isUser($csvFile);
    }

    public function isDepartment(string $tmpName): bool {
        $csvFile = file($tmpName);
        return $this->fileParser->isDepartment($csvFile);
    }

    public function uploadEntitiesFromFileToDatabase(string $tmpName, string $fileName): void {
        $csvFile = file($tmpName);
        if($this->fileParser->isUser($csvFile)) {
            $this->DBService->saveUsers($this->fileParser->getUsers($csvFile), $fileName);
        }
        else {
            $this->DBService->saveDepartments($this->fileParser->getDepartments($csvFile), $fileName);
        }
    }

    public function getAllFiles(): array {
        return array_merge($this->DBService->selectUserFiles(), $this->DBService->selectDepartmentFiles());
    }
}