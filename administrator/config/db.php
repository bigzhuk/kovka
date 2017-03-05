<?php

if ($_SERVER['HTTP_HOST'] === 'kovka.dev') {
    $db_hostname = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_database = 'kovka';
} else {
    $db_hostname = 'mysql94.1gb.ru';
    $db_username = 'gb_kovka';
    $db_password = 'c7a7bdbdps';
    $db_database = 'gb_kovka';
}
$dsn = 'mysql:host='.$db_hostname.';dbname='.$db_database;

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=kovka',
    'username' => $db_username,
    'password' => $db_password,
    'charset' => 'utf8',
];
