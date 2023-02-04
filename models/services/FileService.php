<?php

namespace services;

use services\parser\FileParser;
require_once __DIR__ . "/parser/FileParser.php";
class FileService
{
    private FileParser $fileParser;

    public function __construct() {
        $this->fileParser = new FileParser();
    }

    public function uploadEntitiesFromFileToDatabase(string $fileName): void {
        $csvFile = file($fileName);

        echo '<script>alert("' . $fileName . '")</script>';
        echo '<script>alert("' . count($this->fileParser->parseFile($csvFile)) . '")</script>';
    }
}