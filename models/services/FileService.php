<?php

namespace services;

use Exception;
use services\dao\db\DepartmentDao;
use services\dao\db\FileDao;
use services\dao\db\UserDao;
use services\dao\FileParser;

require_once __DIR__ . "/dao/db/DepartmentDao.php";
require_once __DIR__ . "/dao/db/FileDao.php";
require_once __DIR__ . "/dao/db/UserDao.php";
require_once __DIR__ . "/dao/FileParser.php";
require_once __DIR__ . "/database/DBConnection.php";

class FileService
{
    private FileParser $fileParser;
    private FileDao $fileDao;
    private UserDao $userDao;
    private DepartmentDao $departmentDao;

    public function __construct()
    {
        $this->fileParser = new FileParser();
        $this->fileDao = new FileDao();
        $this->userDao = new UserDao();
        $this->departmentDao = new DepartmentDao();
    }

    public function isUser(string $tmpName): bool
    {
        $csvFile = file($tmpName);
        return $this->fileParser->isUser($csvFile);
    }

    public function isDepartment(string $tmpName): bool
    {
        $csvFile = file($tmpName);
        return $this->fileParser->isDepartment($csvFile);
    }

    /**
     * @throws Exception
     */
    public function uploadEntitiesFromFileToDatabase(string $tmpName, string $fileName): void
    {
        $csvFile = file($tmpName);
        $fileId = $this->fileDao->insertFile($fileName);
        if ($this->fileParser->isUser($csvFile)) {
            try {
                $this->userDao->saveUsers($this->fileParser->getUsers($csvFile), $fileId);
            } catch (Exception $e) {
                $this->fileDao->deleteFile($fileId);
                $this->fileDao->deleteFile($fileId - 1);
                throw $e;
            }
        } else {
            try {
                $this->departmentDao->saveDepartments($this->fileParser->getDepartments($csvFile), $fileId);
            } catch (Exception $e) {
                $this->fileDao->deleteFile($fileId);
                throw $e;
            }
        }
    }

    public function getAllFiles(): array
    {
        return array_merge($this->fileDao->selectUserFiles(), $this->fileDao->selectDepartmentFiles());
    }

    public function getFile($fileId): object
    {
        return $this->fileDao->selectFile($fileId)[0];
    }

    public function getDepartmentsByFile($fileId): array
    {
        return $this->departmentDao->selectDepartmentsByFile($fileId);
    }

    public function getUsersByFile($fileId): array
    {
        return $this->userDao->selectusersByFile($fileId);
    }
}