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
        4 => 'Лестницы и перила',
        5 => 'Ограды',
        6 => 'Ворота',
        7 => 'Заборы',
        8 => 'Мангалы',

    ];

    public static function getPhotoUploadFolderName($category_id) {
        $textcyr = self::$categories[$category_id];
        $cyr = [
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
            'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
            'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
        ];
        $lat = [
            'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
            'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
            'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
            'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
        ];
        return strtolower(str_replace($cyr, $lat, $textcyr));
    }

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
     * @param int $category_id
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAllPublished($category_id, $limit, $offset) {
        $data = array();
        $query = 'SELECT * FROM '.$this->getTableName().' 
                  WHERE is_active = 1 AND category_id = '.(int)$category_id.' 
                  LIMIT '.(int)$limit.' OFFSET '.(int)$offset;
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
     * Возврщает товар по id
     * @return array
     */
    public function getById($id) {
        $query = 'SELECT * FROM '.$this->getTableName().' WHERE is_active = 1 AND id = '.(int)$id;
        $result = DB::i()->getPDO()->query($query);
        if (!$result) {
            return array();
        }
        return $result->fetch();
    }

    /**
     * @return int
     */
    public function count() {
        $query = 'SELECT count(*) as cnt FROM '.$this->getTableName();
        $result = DB::i()->getPDO()->query($query);
        if (!$result) {
            return 0;
        }
        $row = $result->fetch();
        return $row['cnt'];
    }
}


