<?php

namespace Catalog\Decorator;


/** Декоратор каталога для использование на фронте */
class Catalog {

    /**
     * @var количество столбцов в таблице товаров
     */
    public $col_count;
    /**
     * @var количество товаров на странице
     */
    public $item_count;

    private function renderGoodBlock(array $good) {
        $photos = $this->getPhotos($good);
        $thumb_photo_path = self::getThumbPathFromPhotoPath($photos[0]);
        $good_link = 'http://'.$_SERVER['HTTP_HOST'].'/catalog?category_id='.$good['category_id'].'&id='.$good['id'];
      return <<<HTML
      <a href="{$good_link}">
      <div class="prod_box"> 
        <div class ="img_box"><img height="200" width="200" src="{$thumb_photo_path}"></div>
        <div><span class="art">{$good['art']}</span> {$good['name']}</div>
        <div><span class="price">{$good['price']}</span> ₽</div>
      </div>
      </a>
HTML;
    }

    public static function getThumbPathFromPhotoPath($photo_path) {
        $path = explode('/', $photo_path);
        $photo_base_name = array_pop($path);
        $path[] = 'thumbs/'.$photo_base_name;
        return implode('/', $path);
    }

    private function renderCategoryBlock($category_link, $photo_path, $category) {
        return <<<HTML
      <a href="{$category_link}">
      <div class="prod_box"> 
        <div class ="img_box"><img height="200" width="200" src="{$photo_path}"></div>
         <div><span class="price">{$category}</span></div>
      </div>
      </a>
HTML;
    }

    public function renderChooseCategoryList($categories) {
        $select = '<select id="categories">';
        foreach ($categories as $id => $name) {
            if ($id == $_GET['category_id']) {
                $select .= '<option value="'.$id.'" selected>'.$name.'</option>';
            } else {
                $select .= '<option value="' . $id . '">' . $name . '</option>';
            }
        }
        $select .= '</select>';
        return $select;
    }

    public function renderCategoryTable($categories) {
        $key_row_close = 0;
        $max_key = count($categories);
        $category_table = '
        <table class="table table-striped table-bordered">
            <tbody>';
        $col_count = $this->getColCount();
        foreach ($categories as $key => $category) {
            if ($key % $col_count === 1) {
                $key_row_close = $key;
                $category_table .= '<tr>';
            }
            $category_link = 'http://'.$_SERVER['HTTP_HOST'].'/catalog?category_id='.$key;
            $photo_path = '../administrator/uploads/'.\Catalog\Model\Catalog::getPhotoUploadFolderName($key).'/main.jpg';

            $category_table .= '<td>'.$this->renderCategoryBlock($category_link, $photo_path, $category).'</td>';
            if (($key_row_close + 3) === $key || $max_key === $key) {
                $category_table .= '</tr>';
            }
        }
        $category_table .= '
            </tbody>
        </table>';
        return $category_table;
    }

    /**
     * Количество столбцов в таблице с товарами
     * @return int
     */
    private function getColCount() {
       if ($this->col_count) {
           return $this->col_count;
       }

       if (
            empty($_COOKIE['screen_width'])
            || empty($_COOKIE['screen_height'])
       ) {

           $this->col_count = 3;
       } elseif (
             $_COOKIE['screen_width'] < 800
             || $_COOKIE['screen_height'] < 600
       ) {
           $this->col_count = 3;
       } else {
           $this->col_count = 4;
       }

       return $this->col_count;
    }

    public function renderCatalog($categories, $title) {
        return
            '<div align="center">'
                .$this->renderCategoryTable($categories).
            '</div>';
    }

    public function renderFoundGoods($goods) {
        if (empty($goods)) {
            return 'По вашему запросу ни одного товара не найдено :(';
        }
        return
            '<div align="center">'.$this->renderCatalogTable($goods).'</div>
            <p><a href="/catalog">Вернуться в каталог</a></p>';
    }

    private function renderCatalogTable(array $goods) {
        if (empty($goods)) {
            return 'В данной категории пока нет товаров...';
        }

        $max_key = count($goods);
        $good_table = $this->getPaginator();
        $good_table .= '
        <table class="table table-striped table-bordered">
            <tbody>';
            $col_count = $this->getColCount();
            foreach ($goods as $key => $good) {
                if ($key % $col_count === 0) {
                    $key_row_close = $key;
                    $good_table .= '<tr>';
                }
                $good_table .= '<td>'.$this->renderGoodBlock($good).'</td>';
                if (($key_row_close + 3) === $key || $max_key === $key) {
                    $good_table .= '</tr>';
                }
            }
        $good_table .= '
            </tbody>
        </table>';
        $good_table .= $this->getPaginator();
        return $good_table;
    }

    public function renderCategory($categories, $category_id, $goods) {
        return
            '<h2>'.$categories[$category_id].'</h2>
            <div style="padding-bottom: 10px">
            <span style="text-align: center;
    color: #fff;
    background: #C42034;
    padding: 10px;
    border-radius: 3px;">Выбрать другую категорию: '.$this->renderChooseCategoryList($categories).'</span>
    </div>
            <div align="center">'.$this->renderCatalogTable($goods).'
            <p><a href="/catalog">Вернуться в каталог</a></p>
            </div>';
    }

    public function renderGoodPage($good, $categories) {
        if (empty($good)) {
            return 'Товар не найден';
        }
        $photos = $this->getPhotos($good);
        return
            '<h2>'.$good['name'].'</h2>
            <div>
                <div style="float: left; margin-right: 15px; min-height: 200px;"><img src="'.$photos[0].'" style=" border-radius: 5px; width: 200px; height: 200px; "></div>
                <div style="margin-top:25px; margin-bottom: 5px;"><span style="font-weight: bold">Артикул:</span> <span class="art">'.$good['art'].'</span></div>
                <!--<div style="margin-bottom: 5px;"><span style="font-weight: bold">Категория:</span> «'.$categories[$good['category_id']].'»</div>-->
                <div style="margin-bottom: 5px;"><span style="font-weight: bold">Описание:</span> '.$good['description'].'</div>
                <div style="margin-bottom: 5px;"><span style="font-weight: bold">Цена:</span> <span class="price">'.$good['price'].'</span> ₽</div>
                <div>'.\Gallery::drawProductPhotoTable($photos).'</div>
               
            </div>
            
         
            <div align="center">
                <div class="button" onclick="show_recall();">Заказать</div>
            </div>';

    }

    /**
     * @param array $search_params
     * @return string
     */
    public function renderSearchForm($search_params) {
        $f_keyword = !empty($search_params['f_keyword']) ? $search_params['f_keyword'] : '';
        $price_from = !empty($search_params['price_from']) ? $search_params['price_from'] : '';
        $price_to = !empty($search_params['price_to']) ? $search_params['price_to'] : '';
        return '<div class="search-form">
                    <form method="get" action="" id="search-form">
                         <div>
                            <div style="float: left;"><span class="art">Артикул или описание товара:</span>&nbsp;</div><div style="float: right;"><input type="text" name="f_keyword" value="'.$f_keyword.'"></div>
                         </div>
                         <br/>
                         <div>
                            <div style="float: left; margin-top: 2px;"><span class="art">Цена:</span>&nbsp;</div><div style="float: right;"><span class="art">от</span>&nbsp;<input type="text" name="price_from" value="'.$price_from.'">&nbsp;<span class="art">до</span>&nbsp;<input type="text" name="price_to" value="'.$price_to.'"></div>
                         </div>
                         <br/>
                         <div align="center" style="margin-top: 10px;">
                            <div class="button" onclick="searchSubmit()">Искать</div>
                         </div>
                    </form>
                </div>
                <div style="clear: both;"></div>';
    }

    public function getPhotos($good) {
        $photos = explode(',', $good['photo']);
        if (empty($photos)) {
            $photos[] = '..administrator/uploads/IMG_0574.jpg'; // todo no_photo.jpg
        }
        $photos = array_map(function($photo) {return str_replace('..', '../administrator', $photo);}, $photos);
        return $photos;
    }

    /**
     * Количество товаров на странице равно квадрату количества столбцов.
     * При верстке для 3 столбцов будет 9 товаров на странце. Для 4 - 16.
     * @return int
     */
    public function getItemsOnPageCount() {
        if ($this->item_count) {
            return $this->item_count;
        }
        $this->item_count = $this->getColCount()*$this->getColCount();
        return $this->item_count;
    }

    private function getPaginator() {
        $moldel = new \Catalog\Model\Catalog();
        $items_on_page_count = $this->getItemsOnPageCount();
        $out = [];
        $category_id = !empty($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
        $all_items_count = $category_id ? $moldel->countInCategory($category_id) : $items_on_page_count;
        $cur_page = !empty($_GET['page']) ? (int)$_GET['page'] : 0;
        $page_count = $all_items_count/$items_on_page_count;
        if (!is_int($page_count)) {
            $page_count = (int)$page_count + 1;
        }
        $path = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        for ($i = 1; $i <= $page_count; $i++) {
            $path = preg_replace('|&page=\d+|', '', $path);
            $color = $cur_page === $i ? 'darkred' : 'black';
            $out[]= '<a style="color: '.$color.'" href="'.$path.'&page='.$i.'">'.$i.'</a>';
        }
        if (count($out) <=1 ) { // не будем показывать 0 и 1 страницу
            return '';
        }

        return implode('&nbsp;&nbsp;', $out);
    }

}