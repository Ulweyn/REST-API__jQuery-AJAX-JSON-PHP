<?php
// необходимые http-заголовки
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application:json");

// подключение файла для соединения с базой данных
include_once '../configu/database.php';
include_once '../objects/products.php';

// получаем соединение с базой данных
