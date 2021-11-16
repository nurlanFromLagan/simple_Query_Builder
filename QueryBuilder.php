<?php

require 'Connection.php';

class QueryBuilder
{
    private $db;

    /*
     * PDO $pdo - конструктор принимает объект типа PDO, при создании экземпляра класса происходит подключение к БД
     * */

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }


    /*
     * addDb - фунция для добавления данных в таблицу в БД
     * string $table - имя таблицы в БД, тип данных строка (хотя долго сомневался ставить тип string, может ли название таблицы состоять только из цифр и быть int
     * array $data - массив с названиями стлобцов таблицы, тип данных массив
     * */
    public function addDb (string $table, array $data) {

        $keys = array_keys($data);
        $string1 = implode(',', $keys);
        $string2 = ":" . implode(', :', $keys);

        $sql = "INSERT INTO $table($string1) VALUES($string2)";

        $query = $this->db->prepare($sql);
        $query->execute($data);

    }

    /*
     * getAll - фунция для получения всех данных из таблицы в БД, возвращает массив всех строк
     * string $table - имя таблицы в БД, строковый тип данных
     * */
    public function getAll (string $table) {

        $sql = "SELECT * FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }


    /*
     * getOne - функция для получения данных по id из БД, возвращает массив строки
     * string $table - имя таблицы в БД, тип данных строка
     * int id - id строки, тип данных integer
     * */
    public function getOne (string $table, int $id) {

        $sql = "SELECT * FROM $table WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    /*
     * delete - функция для удаления данных из БД, удаляет всю строку по id
     * string $table - имя таблицы в БД, строковый тип данных
     * int id - id строки, тип данных integer
     * */
    public function delete (string $table, int $id) {

        $sql = "DELETE FROM $table WHERE id=:id";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
    }


    /*
     * update - фунция для сохранения внесенных изменений в БД
     * string $table - имя таблицы в БД, тип данных строка
     * array $data - массив с названиями стлобцов таблицы, тип данных массив
     * */
    public function update (string $table, array $data) {

        $keys = array_keys($data);
        $string = '';

        foreach ($keys as $key) {
            $string .= $key . '=:' . $key . ',';
        }

        $string = rtrim($string, ',');

        $sql =" UPDATE {$table} SET {$string} WHERE id=:id";

        $statement = $this->db->prepare($sql);
        $statement->execute($data);
    }
}











