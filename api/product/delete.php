<?php
// необходимые HTTP-заоголовки
header("Access-Control-Allow-Origin: 8");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключил файл для соединения с базой и обьектом Product
include_once '../config/database.php';
include_once '../objects/product.php';

// подключаем соединение с БД
$database = new Database();
$db=$database->get_Connection();

// подготовка обьекта
$product = new Product($db);

// получаем id товара
$data = json_decode(file_get_contents("php://input"));

// установим id товара для удаления
$product->id = $data->id;

// удаление товара
if ($product->delete()){
    // код ответа - 200 ok
    http_response_code(200);

    // сообщение пользователю
    echo json_encode(array("message" => "Товар был удален."),JSON_UNESCAPED_UNICODE);

}

// если не удается удалить товар
else {

    // код ответа - 503 Сервис не доступен
    http_response_code(503);

    // сообщим об этом пользователю
    echo json_encode(array("message"=>"Не удалось удалить товар"));
}
