<?php
// Необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов для соединения с БД и файл с объектом category
include_once '../config/database.php';
include_once '../objects/category.php';

// создание подключения к базе данных
$database = new Database();
$db = $database->get_Connection();

// инициализация объекта
$category = new Category($db);

// запрос для категорий
$stmt = $category->read();
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if($num>0){

    // массива
    $categories_arr=array();
    $categories_arr["records"]=array();

    // получим содержимое нашей таблицы
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        // извлекаем строку
        extract($row);

        $category_item=array(
            "id" => $id,
            "name" => $name,
            "description" => $description
        );

        array_push($categories_arr["records"], $category_item);
    }

    // код ответа - 200 ОК
    http_response_code(200);

    // покажем данные категорий в формате json
    echo json_encode($category_item);

} else {

    // код ответ - 404 Ничего не найдено
    http_response_code(404);

    // сообщим пользователю, что категории не найдены
    echo json_encode(array("message" => "Категории не найдены."), JSON_UNESCAPED_UNICODE);
}