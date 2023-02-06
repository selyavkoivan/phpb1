<?php

namespace models\services;

use entities\Department;
use entities\User;
use Exception;
use models\database\DBConnection;
use models\entities\files\File;
use PDO;
require_once __DIR__ . "/../../models/entities/files/File.php";
require_once __DIR__ . "/database/DBConnection.php";
class DBService
{
    const INSERT_FILE = "INSERT INTO files (file_name) VALUES (?)";
    const DELETE_FILE = "DELETE FROM files WHERE file_id = ?";
    const INSERT_USER = "INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    const DELETE_USER = "DELETE FROM users WHERE xml_id = ?";
    const INSERT_DEPARTMENT = "INSERT INTO departments VALUES (?, ?, ?, ?)";
    const DELETE_DEPARTMENT = "DELETE FROM departments WHERE xml_id = ?";

    const SELECT_USER_FILES = "SELECT file_name as fileName, file_id as fileId, 1 as isUser FROM files
                          WHERE file_id in (SELECT file_id FROM users GROUP BY file_id)";

    const SELECT_DEPARTMENT_FILES = "SELECT file_name as fileName, file_id as fileId, 0 as isUser FROM files
                          WHERE file_id in (SELECT file_id FROM departments GROUP BY file_id)";

    private mixed $conn;

    public function __construct() {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    public function saveUsers($users, $fileName): void {
        $this->insertFile($fileName);
        $stmt = $this->conn->prepare(self::INSERT_USER);
        $fileId = $this->conn->lastInsertId();
        try {
            foreach ($users as $user) {
                $params = array(
                    $user->getXmlId(),
                    $user->getLastName(),
                    $user->getName(),
                    $user->getSecondName(),
                    $user->getDepartment(),
                    $user->getWorkPosition(),
                    $user->getEmail(),
                    $user->getMobilePhone(),
                    $user->getPhone(),
                    $user->getLogin(),
                    $user->getPassword(),
                    $fileId
                );
                $stmt->execute($params);
            }
        } catch(Exception $e) {
            $this->deleteFile($fileId);
            $this->deleteFile($fileId - 1);
            echo '<script>alert("' . "ОШИБКА! Некоторые записи уже находятся в БД, потому во избежание ошибок мы ничего не добавили." . '")</script>';
        }
    }

    public function saveDepartments($departments, $fileName): void
    {
        $this->insertFile($fileName);
        $stmt = $this->conn->prepare(self::INSERT_DEPARTMENT);
        $fileId = $this->conn->lastInsertId();
        try {
            foreach ($departments as $department) {
                $params = array(
                    $department->getXmlId(),
                    $department->getParentXmlId(),
                    $department->getNameDepartment(),
                    $fileId
                );
                $stmt->execute($params);
            }
        } catch(Exception $e) {
            $this->deleteFile($fileId);
            echo '<script>alert("' . "ОШИБКА! Некоторые записи уже находятся в БД, потому во избежание ошибок мы ничего не добавили." . '")</script>';
        }
    }

    public function selectUserFiles(): array {
        $stmt = $this->conn->prepare(self::SELECT_USER_FILES);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, File::class);
    }

    public function selectDepartmentFiles(): array {
        $stmt = $this->conn->prepare(self::SELECT_DEPARTMENT_FILES);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, File::class);
    }

    private function insertFile($fileName): void {
        $stmt = $this->conn->prepare(self::INSERT_FILE);
        $params = array($fileName);
        $stmt->execute($params);
    }

    private function deleteFile($fileId): void {
        $stmt = $this->conn->prepare(self::DELETE_FILE);
        $params = array($fileId);
        $stmt->execute($params);
    }
}