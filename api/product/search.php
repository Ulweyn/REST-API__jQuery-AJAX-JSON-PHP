<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение необходимых файлов
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/product.php';

// создание подключения к БД
$database = new Database();
$db = $database->get_Connection();

// инициализируем обьект
$product = new Product($db);

// получаем ключевые слова
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

// запрос товаров
$stmt = $product->search($keywords);
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num>0){

    // массив товаров
    $products_arr=array();
    $products_arr["records"]=array();

    // получаем содержимое нашей таблицы
    // fetch() быстрее чем fetchAll()
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // извлечем строку
        extract($row);

        $product_item = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "description" => $row['description'],
            "price" => $row['price'],
            "category_id" => $row['category_id'],
            "category_name" => $row['category_name']
        );

        array_push($products_arr["records"],$product_item);
    }

    // код ответа - 200 ok
    http_response_code(200);

    // покажем товары
    echo json_encode($products_arr);
}

else {
    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // скажем пользователю, что товары не найдены
    echo json_encode(array("message"=>"Товары  не найдены."), JSON_UNESCAPED_UNICODE);
}