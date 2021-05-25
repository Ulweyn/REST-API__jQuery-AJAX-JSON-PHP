<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age:3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headews, Authorization, X-Requested-With");

// получаем файл для работы с БД и объектом Product
include_once '../config/database.php';
include_once '../objects/product.php';
// получаем соединение с базой данных
$database = new DataBase();
$db = $database->get_Connection();

// подготовка обьекта
$product = new Product($db);

// получаем id товара для редактирования
$product->id = $data->id;

// установим значения свойств товара
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;

// обновление товара
if ($product->update()){

    // установим код ответа - 200 ok
    http_response_code(200);

    // сообщим пользователю
    echo json_encode(array("message" => "Товар был обновлен."), JSON_UNESCAPED_UNICODE);
}

// если не удается обновить товар, сообщим пользователям
else {
    // код ответа - 503 Сервис не доступен
    http_response_code(503);

    // сообщение пользователю
    echo json_encode(array("message" => "Невозможно обноваить товар."), JSON_UNESCAPED_UNICODE);
}
?>