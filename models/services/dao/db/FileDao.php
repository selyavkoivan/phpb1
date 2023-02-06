<?php

namespace services\dao\db;

use models\database\DBConnection;
use models\entities\files\File;
use PDO;

require_once __DIR__ . "/../../../../models/entities/files/File.php";
require_once __DIR__ . "/../../database/DBConnection.php";

class FileDao
{
    const INSERT_FILE = "INSERT INTO files (file_name) VALUES (?)";
    const DELETE_FILE = "DELETE FROM files WHERE file_id = ?";

    const SELECT_USER_FILES = "SELECT file_name as fileName, file_id as fileId, 1 as isUser FROM files
                          WHERE file_id in (SELECT file_id FROM users GROUP BY file_id)";

    const SELECT_DEPARTMENT_FILES = "SELECT file_name as fileName, file_id as fileId, 0 as isUser FROM files
                          WHERE file_id in (SELECT file_id FROM departments GROUP BY file_id)";

    const SELECT_FILE_BY_ID = "SELECT file_name as fileName, file_id as fileId, EXISTS (SELECT * FROM users 
WHERE file_id = ?) as isUser FROM files
WHERE file_id = ?";

    private mixed $conn;

    public function __construct()
    {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    public function selectUserFiles(): array
    {
        $stmt = $this->conn->prepare(self::SELECT_USER_FILES);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, File::class);
    }

    public function selectDepartmentFiles(): array
    {
        $stmt = $this->conn->prepare(self::SELECT_DEPARTMENT_FILES);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, File::class);
    }

    public function selectFile($fileId): array
    {
        $stmt = $this->conn->prepare(self::SELECT_FILE_BY_ID);
        $params = array(
            $fileId,
            $fileId
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_CLASS, File::class);
    }

    public function insertFile($fileName): int
    {
        $stmt = $this->conn->prepare(self::INSERT_FILE);
        $params = array($fileName);
        $stmt->execute($params);
        return $this->conn->lastInsertId();
    }

    public function deleteFile($fileId): void
    {
        $stmt = $this->conn->prepare(self::DELETE_FILE);
        $params = array($fileId);
        $stmt->execute($params);
    }
}