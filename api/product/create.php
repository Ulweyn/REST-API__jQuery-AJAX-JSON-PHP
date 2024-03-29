<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// получаем соединение с базой данных
include_once '../config/database.php';

// создание объекта товара
include_once '../objects/product.php';

$database = new Database();
$db=$database->get_Connection();

$product = new Product($db);

// получаем запрашиваемые данные
$data = json_decode(file_get_contents("php://input"));

// убеждаемся что данные не пусты
if(
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->description) &&
    !empty($data->category_id) 
){

    // устанавливаем значения свойств товара
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->category_id = $data->category_id;
    $product->created = date('Y-m-d H:i:s');

    // создание товара
    if($product->create()){

        // код ответа - 201 - создано
        http_response_code(201);

        // ответ пользователю
        echo json_encode(array("message"=>"Товар был создан."),JSON_UNESCAPED_UNICODE);
    } else {
        // устанавливаем код ответа - 503 сервис недоступен
        http_response_code(503);

        // ответ пользователю
        echo json_encode(array("message"=>"Невозможно создать товар."),JSON_UNESCAPED_UNICODE);

    }
}
    // сообщаем что данные неполные
else{

    // установмс код ответа - 400 неверный запрос
    http_response_code(400);

    // сообщим пользователю
    echo json_encode(array("message"=>"Невозмножно создать товар. Данные неполные"),JSON_UNESCAPED_UNICODE);
    
}
?>