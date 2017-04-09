<?php

if ($_SERVER['HTTP_HOST'] === 'kovka.dev') {
    $db_hostname = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_database = 'kovka';
} else {
    $db_hostname = 'p377048.ispmgr.ihc.ru';
    $db_username = 'p377048_kovka';
    $db_password = 'c7a7bdbdps';
    $db_database = 'p377048_kovka';
}
$dsn = 'mysql:host='.$db_hostname.';dbname='.$db_database;

return [
    'class' => 'yii\db\Connection',
    'dsn' => $dsn,
    'username' => $db_username,
    'password' => $db_password,
    'charset' => 'utf8',
];
