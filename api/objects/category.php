<?php


class Category {

    // соединение с БД и таблицей 'categories'
    private $conn;
    private $table_name = "categories";

    // свойство обьекта
    public $id;
    public $name;
    public $description;
    public $created;

    public function __construct($db){
        $this->conn = $db;
    }

    // используем раскрывающийся список выбора
    public function readAll(){
        // выборка всех данных
        $querry = "SELECT
                    id, name, description
                   FROM
                       " .$this->table_name . "
                   ORDER BY
                       name";
        $stmt = $this->conn->prepare($querry);
        $stmt->execute();

        return $stmt;
    }
}