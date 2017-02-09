<?php

namespace Catalog\Model;

use DB\DB;


/** Модель каталога для использование на фронте */
class Catalog {

    /**
     * @var array
     * @see administrator/models/Catalog.php
     * На админку был поставлен yii2, а на фронте была самописная модель.
     * Желание ебаться с автолоадом, чтобы их "подружить" - нет. Поэтому если добавляется категория
     * сюда: self::$categories она должна добавиться и в app\models\Catalog::$categories.
     */
    public static $categories = [
        1 => 'Навесы',
        2 => 'Балконы',
        3 => 'Беседки',
        4 => 'Лестницы',
        5 => 'Перила',
        6 => 'Ограды',
        7 => 'Ворота',
        8 => 'Заборы',
        9 => 'Мангалы',

    ];

    public function getTableName() {
        return 'catalog';
    }

    /**
     * Возврщает массив строк таблицы
     * @return array
     */
    public function getAll() {
        $data = array();
        $query = 'SELECT * FROM '.$this->getTableName();
        $result = DB::i()->getPDO()->query($query);
        while($row = $result->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Возврщает массив строк таблицы, дата начала публикации которых меньше либо равна сегодняшнему дню,
     * а дата конца публикации больше сегодняшнего дня
     * @return array
     */
    public function getAllPublished($category_id) {
        $data = array();
        $query = 'SELECT * FROM '.$this->getTableName().' WHERE is_active = 1 AND category_id = '.(int)$category_id;
        $result = DB::i()->getPDO()->query($query);
        if(!$result) {
            return array();
        }
        while($row = $result->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Возвращает массив с данными о новости эквивалентный строке в таблице
     * @param $id
     * @return array
     */
    public function getById($id) {
        $query = 'SELECT * FROM '.$this->getTableName().' WHERE id='.(int)$id;
        $result = DB::i()->getPDO()->query($query);
        if(!$result) {
            return array();
        }
        $row = $result->fetch();
        return $row;
    }
}


