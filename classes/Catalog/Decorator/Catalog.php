<?php

namespace Catalog\Decorator;


/** Декоратор каталога для использование на фронте */
class Catalog {

    private function renderGoodBlock(array $good) {
        $photos = $this->getPhotos($good);
        $good_link = 'http://'.$_SERVER['HTTP_HOST'].'/catalog?category_id='.$good['category_id'].'&id='.$good['id'];
      return <<<HTML
      <a href="{$good_link}">
      <div class="prod_box"> 
        <div class ="img_box"><img height="200" width="200" src="{$photos[0]}"></div>
        <div><span class="art">{$good['art']}</span> {$good['name']}</div>
        <div><span class="price">{$good['price']}</span> ₽</div>
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

    private function renderCatalogTable(array $goods) {
        if (empty($goods)) {
            return 'В данной категории пока нет товаров...';
        }

        $max_key = count($goods);
        $good_table = '
        <table class="table table-striped table-bordered">
            <tbody>';
            foreach ($goods as $key => $good) {
                if ($key % 4 === 0) {
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
        return $good_table;
    }

    public function renderCategory($categories, $category_id, $goods) {
        return
            '<h2>'.$categories[$category_id].'</h2>
            <span style="    text-align: center;
    color: #fff;
    background: #C42034;
    padding: 5px;
    border-radius: 3px;">Выберите категорию: '.$this->renderChooseCategoryList($categories).'</span>
            <div align="center">'.$this->renderCatalogTable($goods).'</div>';
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

    public function getPhotos($good) {
        $photos = explode(',', $good['photo']);
        if (empty($photos)) {
            $photos[] = '..administrator/uploads/IMG_0574.jpg'; // todo no_photo.jpg
        }
        $photos = array_map(function($photo) {return str_replace('..', '../administrator', $photo);}, $photos);
        return $photos;
    }

}