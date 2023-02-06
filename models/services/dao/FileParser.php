<?php

namespace services\dao;

use entities\Department;
use entities\User;

require_once __DIR__ . "/../../entities/Department.php";
require_once __DIR__ . "/../../entities/User.php";

class FileParser
{
    const SEPARATOR = ";";
    const USER_COUNT = 11;
    const DEPARTMENT_COUNT = 3;

    public function isUser($csvFile): bool {
        return $this->getCountOfColumns($csvFile) == self::USER_COUNT;
    }

    public function isDepartment(array $csvFile)
    {
        return $this->getCountOfColumns($csvFile) == self::DEPARTMENT_COUNT;
    }

    public function getCountOfColumns($csvFile): int {
        return count(str_getcsv($csvFile[0], self::SEPARATOR));
    }

    public function getUsers($csvFile): array {
        $users = [];
        for($i = 1; $i < count($csvFile); $i++) {
            $csvLine = str_getcsv($csvFile[$i], self::SEPARATOR);
            $user = new User();
            $user->setData($csvLine);
            $users[] = $user;
        }
        return $users;
    }

    public function getDepartments($csvFile): array {
        $departments = [];
        for($i = 1; $i < count($csvFile); $i++) {
            $csvLine = str_getcsv($csvFile[$i], self::SEPARATOR);
            $department = new Department();
            $department->setData($csvLine);
            $departments[] = $department;
        }
        return $departments;
    }
}