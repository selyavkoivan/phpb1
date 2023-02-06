<?php

namespace services\dao\db;

use entities\Department;
use Exception;
use models\database\DBConnection;
use PDO;

require_once __DIR__ . "/../../../../models/entities/files/File.php";
require_once __DIR__ . "/../../database/DBConnection.php";

class DepartmentDao
{
    const INSERT_DEPARTMENT = "INSERT INTO departments VALUES (?, ?, ?, ?)";

    const SELECT_DEPARTMENTS_BY_FILE = "SELECT xml_id AS xmlId,
       parent_xml_id AS parentXmlId, 
       name_department AS nameDepartment FROM departments WHERE file_id = ?";

    private mixed $conn;

    public function __construct()
    {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    /**
     * @throws Exception
     */
    public function saveDepartments($departments, $fileId): void
    {
        $stmt = $this->conn->prepare(self::INSERT_DEPARTMENT);

        foreach ($departments as $department) {
            $params = array(
                $department->getXmlId(),
                $department->getParentXmlId(),
                $department->getNameDepartment(),
                $fileId
            );
            $stmt->execute($params);
        }
    }

    public function selectDepartmentsByFile($fileId): array
    {
        $stmt = $this->conn->prepare(self::SELECT_DEPARTMENTS_BY_FILE);
        $params = array(
            $fileId
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Department::class);
    }
}