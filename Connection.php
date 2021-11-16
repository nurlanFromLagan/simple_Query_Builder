<?php

require  __DIR__ .'config.php';

class Connection
{

    /*
     * make - функция для подключения к БД
     * DB_HOST - имя хоста
     * DB_NAME - имя БД
     * DB_USER - имя пользователя БД
     * DB_PASS  - пароль
     * данные из констант находятся в стороннем файле config.php
     * */
    public static function make () {
        $dsn = 'mysql:host='. DB_HOST. ';dbname='. DB_NAME;
        return new PDO($dsn, DB_USER, DB_PASS);
    }
}