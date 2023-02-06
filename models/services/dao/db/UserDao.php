<?php

namespace services\dao\db;

use entities\User;
use Exception;
use models\database\DBConnection;
use PDO;

require_once __DIR__ . "/../../../../models/entities/files/File.php";
require_once __DIR__ . "/../../database/DBConnection.php";

class UserDao
{
    const INSERT_USER = "INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    const DELETE_USER = "DELETE FROM users WHERE xml_id = ?";

    private const SELECT_USERS_BY_FILE = "SELECT xml_id AS xmlId,
       last_name AS lastName, 
       name,
       second_name AS secondName,
       department, 
       work_position AS workPosition, 
       email, 
       mobile_phone AS mobilePhone, 
       phone, 
       login, 
       password FROM users  WHERE file_id = ?";

    private mixed $conn;

    public function __construct()
    {
        $this->conn = DBConnection::getInstance()->getConnection();
    }

    /**
     * @throws Exception
     */
    public function saveUsers($users, $fileId): void
    {
        $stmt = $this->conn->prepare(self::INSERT_USER);

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

    }

    public function selectUsersByFile($fileId): array
    {
        $stmt = $this->conn->prepare(self::SELECT_USERS_BY_FILE);
        $params = array(
            $fileId
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_CLASS, User::class);
    }
}