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
        1 => ['title' => 'Навесы', 'order' => 1, 'subcategories' => [1,3, 9, 10]],
        2 => ['title' => 'Балконы', 'order' => 4, 'subcategories' => [1,2]],
        3 => ['title' => 'Беседки', 'order' => 3, 'subcategories' => [1,2]],
        4 => ['title' => 'Лестницы', 'order' => 6, 'subcategories' => [4,5]],
        5 => ['title' => 'Ограды', 'order' => 12, 'subcategories' => [1,2]],
        6 => ['title' => 'Ворота', 'order' => 9, 'subcategories' => [1,2,7,8]],
        7 => ['title' => 'Заборы', 'order' => 8, 'subcategories' => [1,2,6]],
        8 => ['title' => 'Мангалы', 'order' => 16, 'subcategories' => []],
        9 => ['title' => 'Козырьки', 'order' => 2, 'subcategories' => [1,2]],
        10 => ['title' => 'Решетки', 'order' => 7, 'subcategories' => [1,2]],
        11 => ['title' => 'Калитки', 'order' => 10, 'subcategories' => [1,2]],
        12 => ['title' => 'Скамейки', 'order' => 15, 'subcategories' => [1,2]],
        13 => ['title' => 'Качели', 'order' => 14, 'subcategories' => [1,2]],
        14 => ['title' => 'Столы', 'order' => 17, 'subcategories' => []],
        15 => ['title' => 'Стулья', 'order' => 18, 'subcategories' => []],
        16 => ['title' => 'Фонари', 'order' => 21, 'subcategories' => []],
        17 => ['title' => 'Цветочницы', 'order' => 19, 'subcategories' => []],
        18 => ['title' => 'Урны', 'order' => 20, 'subcategories' => []],
        19 => ['title' => 'Перила', 'order' => 5, 'subcategories' => [1,2]],
        20 => ['title' => 'Мебель и интерьер',  'order' => 13, 'subcategories' => []],
        21 => ['title' => 'Газонные ограждения',  'order' => 11, 'subcategories' => [1,2]],
        22 => ['title' => 'Арки',  'order' => 22, 'subcategories' => []],
        23 => ['title' => 'Мостики',  'order' => 23, 'subcategories' => []],
        24 => ['title' => 'Металло-конструкции',  'order' => 24, 'subcategories' => []],
    ];

    public static $subcategories = [
        0 => 'Не указана',
        1 => 'Кованные',
        2 => 'Сварные',
        3 => 'Над бассейном',
        4 => 'Маршевые',
        5 => 'Винтовые',
        6 => 'Из профнастила',
        7 => 'Откатные',
        8 => 'Гаражные',
        9 => 'Над крыльцом',
        10 => 'Для машин',
    ];

    public static function getOrderedCategories() {
       $categories = [];
       foreach (self::$categories as $id => $category) {
           $categories[$category['order']] = ['title' => $category['title'], 'id' => $id, 'subcategories' => $category['subcategories']];
       }
       ksort($categories);
       return $categories;
    }

    public static function getKeyValCategories() {
        $categories = [];
        foreach (self::$categories as $id => $category) {
            $categories[$id] = $category['title'];
        }
        return $categories;
    }

    public static function getPhotoUploadFolderName($category_id) {
        $textcyr = self::getKeyValCategories()[$category_id];
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
     * @param int $subcategory_id
     * @param int $limit
     * @param int $offset
     * @param array $search_params
     * @return array
     */
    public function getAllPublished($category_id, $subcategory_id, $limit, $offset, $search_params = []) {
        $data = array();
        $query = 'SELECT * FROM '.$this->getTableName().' 
                  WHERE is_active = 1 '
                    .$this->getCategoryWhere($category_id, $subcategory_id)
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
        return" AND price_int >={$price_from} ";
    }

    /**
     * @param int $price_to
     * @return string
     */
    private function getPriceToWhere($price_to) {
        if ($price_to === 0) {
            return '';
        }
        return" AND price_int <={$price_to} ";
    }

    private function getCategoryWhere($category_id, $subcategory_id) {
        $out = '';
        $out .= $category_id ? ' AND category_id = '.(int)$category_id: '';
        $out .= $subcategory_id ? ' AND subcategory_id = '.(int)$subcategory_id: '';
        return $out;
    }
}


