<?php

namespace Catalog\Model;

use DB\DB;
use DB\Escape;


/** Модель каталога для использование на фронте */
class Catalog {

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
    public function getAllPublished() {
        $data = array();
        $query = 'SELECT * FROM '.$this->getTableName().' WHERE is_active = 1';
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


