<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headews, Authorization, X-Requested-With");

// получаем файл для работы с БД и объектом Product
incelude_once '../config/database.php';
incelude_once '../objects/product.php';

// получаем соединение с базой данных
$database = new DataBase();
$db = $database->getConnection();

// подготовка обьекта
$product = new Product($db);
