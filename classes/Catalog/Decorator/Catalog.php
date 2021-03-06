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
        $main_photo_number = $this->getMainPhotoNumber($good);
        $thumb_photo_path = self::getThumbPathFromPhotoPath($photos[$main_photo_number]);

      return <<<HTML
      <div class="prod_box"> 
        <div class ="img_box parent_"><img height="200" width="200" src="{$thumb_photo_path}"></div>
        <div><span class="art">{$good['art']}</span> {$good['name']}</div>
        <div><span class="price">{$good['price']}</span> ₽</div>
      </div>
HTML;
    }

    public static function getThumbPathFromPhotoPath($photo_path) {
        $path = explode('/', $photo_path);
        $photo_base_name = array_pop($path);
        $path[] = 'thumbs/'.$photo_base_name;
        return implode('/', $path);
    }

    private function renderCategoryBlock($category_link, $photo_path, $category) {
        $subcategories = $this->renderSubCategoriesLinks($category);
        return <<<HTML
      <a href="{$category_link}">
          <div class="prod_box"> 
             <div class ="img_box"><img height="200" width="200" src="{$photo_path}"></div>
             <div><span class="price">{$category['title']}</span></div>
             <div class="subcategories_list">{$subcategories}</div>
          </div>
      </a>
HTML;
    }

    private function renderSubCategoriesLinks(array $category) {
        $out = '';
        foreach ($category['subcategories'] as $subcategory_id) {
            $out .= '<div class="subcategory_link">
                        <a href="/catalog?category_id='.$category['id'].'&subcategory_id='.$subcategory_id.'">'.\Catalog\Model\Catalog::$subcategories[$subcategory_id].'</a>
                     </div>';
        }
        return $out;
    }

    public function renderChooseCategoryList() {
        $categories = \Catalog\Model\Catalog::getOrderedCategories();
        $select = '<select id="categories">';
        foreach ($categories as $order => $category) {
            if ($category['id'] == $_GET['category_id']) {
                $select .= '<option value="'.$category['id'].'" selected>'.$category['title'].'</option>';
            } else {
                $select .= '<option value="' . $category['id'] . '">' . $category['title'] . '</option>';
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
            $category_link = 'http://'.$_SERVER['HTTP_HOST'].'/catalog?category_id='.$category['id'];
            $photo_path = '../administrator/uploads/'.\Catalog\Model\Catalog::getPhotoUploadFolderName($category['id']).'/main.jpg';

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
            '<div align="center">
                <!--<div style="float: left; margin-top: -6px;">'.$this->renderLeftMenu().'</div>-->
                <div> <!--style="float: right;"-->'.$this->renderCategoryTable($categories).'</div>
                <div style="clear:both;"></div>
            </div>';
    }

    public function renderFoundGoods($goods) {
        if (empty($goods)) {
            return 'По вашему запросу ни одного товара не найдено :(';
        }
        return
           '<div align="center">'.$this->renderCatalogTable($goods).'
            <p><a href="/catalog">Вернуться в каталог</a></p>
            </div>';
    }

    private function renderCatalogTable(array $goods) {
        if (empty($goods)) {
            return 'В данной категории пока нет товаров...';
        }

        $max_key = count($goods);
        $good_table = $this->getPaginator();
        $good_table .= '
        <table class="table table-striped table-bordered parent-container"">
            <tbody>';
            $col_count = $this->getColCount();
            foreach ($goods as $key => $good) {
                $photos = $this->getPhotos($good);

                if ($key % $col_count === 0) {
                    $key_row_close = $key;
                    $good_table .= '<tr>';
                }
                $main_photo_number = $this->getMainPhotoNumber($good);
                $good_table .= '<td href="'.$photos[$main_photo_number].'" id="'.$good['id'].'" title="'.$good['art'].'" data-category-id="'.$good['category_id'].'">'.$this->renderGoodBlock($good).'</td>';
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

    /**
     * @param array $good
     * @return int
     */
    private function getMainPhotoNumber($good) {
        return !empty($good['main_photo_number']) ? $good['main_photo_number'] - 1 : 0;
    }

    public function renderCategory($category_id, $subcategory_id,  $goods) {
        $title = '';
        $title .= $category_id ? \Catalog\Model\Catalog::getKeyValCategories()[$category_id].' ' : '';
        $title .= $subcategory_id ? \Catalog\Model\Catalog::$subcategories[$subcategory_id].' ' : '';
        return
            '<h2>'.$title.'</h2>
            <div align="center">'.$this->renderCatalogTable($goods).'
            <p><a href="/catalog">Вернуться в каталог</a></p>
            </div>';
    }

    public function renderGoodPage($good, $categories) {
        if (empty($good)) {
            return 'Товар не найден';
        }
        $photos = $this->getPhotos($good);
        $main_photo_number = $this->getMainPhotoNumber($good);
        return
            '<h2>'.$good['name'].'</h2>
            <div>
                <div style="float: left; margin-right: 15px; min-height: 200px;"><img src="'.$photos[$main_photo_number].'" style=" border-radius: 5px; width: 200px; height: 200px; "></div>
                <div style="margin-top:25px; margin-bottom: 5px;"><span style="font-weight: bold">Артикул:</span> <span class="art">'.$good['art'].'</span></div>
                <!--<div style="margin-bottom: 5px;"><span style="font-weight: bold">Категория:</span> «'.$categories[$good['category_id']].'»</div>-->
                <div style="margin-bottom: 5px;"><span style="font-weight: bold">Описание:</span> '.$good['description'].'</div>
                <div style="margin-bottom: 5px;"><span style="font-weight: bold">Цена:</span> <span class="price">'.$good['price'].'</span> ₽</div>
                <div>'.\Gallery\Index::drawProductPhotoTable($photos).'</div>
               
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
                           <div style="float: left; margin-right: 20px; width: 50%" class="art">
                                <div style="float: left;" >Артикул или описание товара:</div>&nbsp;
                                <div><input type="text" name="f_keyword" value="'.$f_keyword.'" style="width: 100%;"></div>
                           </div>     
                           <div style="float: left; margin-right: 20px; min-width:200px" class="art">
                                <div style="float: left;"  >Цена:</div>&nbsp;
                                <div>от</span>&nbsp;<input type="text" name="price_from" value="'.$price_from.'">&nbsp;до&nbsp;<input type="text" name="price_to" value="'.$price_to.'"></div>  
                            </div>
                           <div style="float: left; margin-top: 15px;" class="button" onclick="searchSubmit()">Искать</div>
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

    private function renderLeftMenuContent() {
        $out = '';
        $categories = \Catalog\Model\Catalog::getOrderedCategories();
        $out .='
         <div class="category">
            <ul id="menu">';
            foreach ($categories as $category) {


                if (empty($category['subcategories'])) {
                    $out .= '<li><a href="/catalog?category_id=' . $category['id'] . '">' . $category['title'] . '</a></li>';
                } else {
                    $out .= '<li class="sub"><a href="#">'.$category['title'].'</a>';
                    $out .= '<ul>';
                    foreach ($category['subcategories'] as $subcategory_id) {
                        $out .= '<li><a href="/catalog?category_id=' . $category['id'] . '&subcategory_id=' . $subcategory_id . '">' . \Catalog\Model\Catalog::$subcategories[$subcategory_id] . '</a></li>';
                    }
                    $out .= '</ul>';
                    $out .= '</li>';
                }
            }
            /*<li><a href="http://dbmast.ru">Просто ссылка</a></li>
            <li class="sub"><a href="#">Пункт Меню - 1</a>
              <ul>
                <li><a href="http://dbmast.ru">Ссылка 1-1</a></li>
                <li><a href="#">Ссылка 1-2</a></li>
                <li><a href="#">Ссылка 1-3</a></li>
              </ul>
            </li>
            <li class="sub"><a href="#">Пункт Меню - 2</a>
              <ul>
                <li><a href="#">Ссылка 2-1</a></li>
                <li><a href="#">Ссылка 2-2</a></li>
              </ul>
            </li>
            <li class="sub"><a href="#">Пункт Меню - 3</a>
              <ul>
                <li><a href="#">Ссылка 3-1</a></li>
                <li><a href="#">Ссылка 3-1</a></li>
                <li><a href="#">Ссылка 3-1</a></li>
                <li><a href="#">Ссылка 3-1</a></li>
              </ul>
            </li>
            <li><a href="#">Просто ссылка</a></li>*/
         $out .= '
            </ul>
         </div>';

        return $out;
    }

    public function renderLeftMenu() {
        $out =
            '<div id="left_menu">
                '.$this->renderLeftMenuContent().'
            </div>';

        return $out;
    }

    public static function renderRalTds($ral, $from, $to) {

        $out = '';
        for ($i=$from; $i<=$to; $i++) {
            $path = explode('/', $ral[$i]);
            $title = substr($path[2], 0,-4);
            $out .= '<td><img src="'.$ral[$i].'"><br>'.$title.'</td>';
        }
        return $out;
    }

}