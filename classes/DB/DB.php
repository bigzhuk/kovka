<?php

namespace DB;

use PDO;
use PDOException;

class DB {
    private static $instance = null;

    private $host = 'p377048.ispmgr.ihc.ru';
    private $dbname  = 'p377048_kovka';
    private $user  = 'p377048_kovka';
    private $password = 'c7a7bdbdps';
    private $charset = 'UTF8';


    private function __construct() {
        if ($_SERVER['HTTP_HOST'] == 'kovka.dev') {
             $this->host = 'localhost';
             $this->dbname = 'kovka';
             $this->user = 'root';
             $this->password = '';
             $this->charset = 'UTF8';
        }
    }
    private function __clone() {}

    public function getPDO() {
        try {
            $dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';charset='.$this->charset, $this->user, $this->password);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }
        $dbh->exec('SET NAMES utf8');
        return $dbh;
    }

    public static function i() {
        if(is_null(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }
}
