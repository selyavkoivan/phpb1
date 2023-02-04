<?php

namespace services\parser;

use entities\Department;
use entities\User;

require_once __DIR__ . "/../../entities/Department.php";
require_once __DIR__ . "/../../entities/User.php";

class FileParser
{
    const SEPARATOR = ";";
    const USER_COUNT = 11;
    const DEPARTMENT_COUNT = 3;

    public function parseFile($csvFile): array {
        return $this->getCountOfColumns($csvFile) == self::USER_COUNT ?
            $this->getUsers($csvFile) : $this->getDepartments($csvFile);
    }

    private function getCountOfColumns($csvFile): int {
        return count(str_getcsv($csvFile[0], self::SEPARATOR));
    }

    private function getUsers($csvFile): array {
        $users = [];
        for($i = 1; $i < count($csvFile); $i++) {
            $user = new User(str_getcsv($csvFile[$i], self::SEPARATOR));
            $users[] = $user;
        }
        return $users;
    }

    private function getDepartments($csvFile): array {
        $departments = [];
        for($i = 1; $i < count($csvFile); $i++) {
            $department = new Department(str_getcsv($csvFile[$i], self::SEPARATOR));
            $departments[] = $department;
        }
        return $departments;
    }
}