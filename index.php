<?php

require_once __DIR__ . "/controllers/IndexController.php";

// создаем объект контроллера и вызываем метод, который вернет нам главную страницу
$controller = new IndexController();
$controller->executeRequest();
