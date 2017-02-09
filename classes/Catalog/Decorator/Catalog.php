<?php

namespace Catalog\Decorator;


/** Декоратор каталога для использование на фронте */
class Catalog {

    private function renderGoodBlock(array $good) {
        $photos = explode(',', $good['photo']);
        if (empty($photos)) {
            $photos[] = '..administrator/uploads/IMG_0574.jpg'; // todo no_photo.jpg
        }
        $photos = array_map(function($photo) {return str_replace('..', '../administrator', $photo);}, $photos);

      return <<<HTML
      <div class="prod_box"> 
        <div class ="img_box"><img height="200" width="200" src="{$photos[0]}"></div>
        <div><span class="art">{$good['art']}</span> {$good['name']}</div>
        <div><span class="price">{$good['price']}</span> ₽</div>
      </div>
HTML;
    }

    public function renderChooseCategoryList($categories) {
        $select = '<select id="categories">';
        foreach ($categories as $id => $name) {
            if ($id == $_GET['category_id']) {
                $select .= '<option value="'.$id.'" selected>'.$name.'</option>';
            }
            $select .= '<option value="'.$id.'">'.$name.'</option>';
        }
        $select .= '</select>';
        return $select;
    }

    public function renderCatalogTable(array $goods) {
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

}