<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/product.php';

    $database = new Database();
    $db = $database->get_Connection();

    $product = new Product($db);

    $stmt=$product->read();
    $num=$stmt->rowCount();

    if($num>0){

        // извлекаем строку
        $products_arr=array();
        $products_arr["records"]=array();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // Извлекаем строку



            $product_item= array(
                "id" => $row['id'],
                "name" => $row['name'],
                "description" => html_entity_decode($row['description']),
                "price" => $row['price'],
                "category_id" => $row['category_id'],
                "category_name" => $row['category_name']
            );

            array_push($products_arr["records"], $product_item);
        
        }
        // устанавливаем код ответа - 200 ЩЛ
        http_response_code(200);

        // выводим данные о товаре в формате JSON
        echo json_encode($products_arr);

    } else {
        http_response_code(404);
        echo json_encode (array("message" => "Товары не найдены"), JSON_UNESCAPED_UNICODE);
    }

?>