<?php

use services\FileService;

require_once __DIR__ . "/../models/services/FileService.php";

class IndexController
{
    private FileService $fileService;

    public function __construct()
    {
        $this->fileService = new FileService();
    }

    public function executeRequest(): void
    {
        // если есть загруженные файлы
        if ($_FILES) {
            // если их два
            if(count($_FILES['file']['tmp_name']) == 2) {
                try {
                    // если их структура соответствует необходимой нам
                    if ($this->fileService->isUser($_FILES['file']['tmp_name'][0]) &&
                        $this->fileService->isDepartment($_FILES['file']['tmp_name'][1])) {
                        // загружаем в бд
                        $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name'][1], $_FILES['file']['name'][1]);
                        $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name'][0], $_FILES['file']['name'][0]);
                    } else if ($this->fileService->isUser($_FILES['file']['tmp_name'][1]) &&
                        $this->fileService->isDepartment($_FILES['file']['tmp_name'][0])) {
                        $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name'][0], $_FILES['file']['name'][0]);
                        $this->fileService->uploadEntitiesFromFileToDatabase($_FILES['file']['tmp_name'][1], $_FILES['file']['name'][1]);
                    } else {
                        echo '<script>alert("' . "ОШИБКА! Загрузите один user и один department файлы" . '")</script>';
                    }
                } catch (Exception $e) {
                    echo '<script>alert("' . "ОШИБКА! Некоторые записи уже находятся в БД, потому во избежание ошибок мы ничего не добавили." . '")</script>';
                }
            }
            else {
                echo '<script>alert("' . "ОШИБКА! Загрузите один user и один department файлы" . '")</script>';
            }
        }

        $files = $this->fileService->getAllFiles();
        include_once __DIR__ . "/../views/home.php";
    }
}