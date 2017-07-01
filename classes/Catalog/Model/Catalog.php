<?php

namespace Catalog\Model;

use DB\DB;
use DB\Escape;


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
        5 => 'Ограды',
        6 => 'Ворота',
        7 => 'Заборы',
        8 => 'Мангалы',
        9 => 'Козырьки',
        10 => 'Решетки',
        11 => 'Калитки',
        12 => 'Скамейки',
        13 => 'Качели',
        14 => 'Столы',
        15 => 'Стулья',
        16 => 'Фонари',
        17 => 'Цветочницы',
        18 => 'Урны',
        19 => 'Перила',
        20 => 'Мебель и интерьер',


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
     * @param array $search_params
     * @return array
     */
    public function getAllPublished($category_id, $limit, $offset, $search_params = []) {
        $data = array();
        $query = 'SELECT * FROM '.$this->getTableName().' 
                  WHERE is_active = 1 '
                    .$this->getCategoryWhere($category_id)
                    .$this->getSearchWhere($search_params)
                    .' LIMIT '.(int)$limit.' OFFSET '.(int)$offset;
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
    public function countInCategory($category_id) {
        $query = 'SELECT count(*) as cnt FROM '.$this->getTableName().' WHERE category_id='.$category_id;
        $result = DB::i()->getPDO()->query($query);
        if (!$result) {
            return 0;
        }
        $row = $result->fetch();
        return $row['cnt'];
    }

    /**
     * @param array $search_params
     * @return string
     */
    private function getSearchWhere($search_params) {
        $search_where = '';

        $f_keyword = !empty($search_params['f_keyword']) ? Escape::i()->getString($search_params['f_keyword']) : '';
        $price_from = !empty($search_params['price_from']) ? (int)$search_params['price_from'] : 0;
        $price_to = !empty($search_params['price_to']) ? (int)$search_params['price_to'] : 0;

        $search_where .= $this->getFkeywordWhere($f_keyword);
        $search_where .= $this->getPriceFromWhere($price_from);
        $search_where .= $this->getPriceToWhere($price_to);

        return $search_where;
    }

    /**
     * @param string|null $f_keyword
     * @return string
     */
    private function getFkeywordWhere($f_keyword) {
        if (empty($f_keyword)) {
            return '';
        }
        if (strlen($f_keyword) < 3) {
            return '';
        }
        $f_keyword = iconv("utf-8", "utf-8", $f_keyword);
        // $f_keyword = Escape::i()->getString($f_keyword);
        $search_where = " AND art LIKE '%{$f_keyword}%' OR name LIKE '%{$f_keyword}%' OR description LIKE '%{$f_keyword}%'";
        return $search_where;
    }

    /**
     * @param int $price_from
     * @return string
     */
    private function getPriceFromWhere($price_from) {
        if ($price_from === 0) {
            return '';
        }
        return" AND price >={$price_from} ";
    }

    /**
     * @param int $price_to
     * @return string
     */
    private function getPriceToWhere($price_to) {
        if ($price_to === 0) {
            return '';
        }
        return" AND price <={$price_to} ";
    }

    private function getCategoryWhere($category_id) {
        return $category_id ? ' AND category_id = '.(int)$category_id: '';
    }
}


