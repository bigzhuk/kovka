<?php
namespace News\Decorator;

class BlockKovkaFront extends News {
   public function renderReklamniyBlock(array $new_rows) {
       if (empty($new_rows)) {
           return '';
       }
       $show_item_number = rand(0, count($new_rows)-1); // если опубликовано несколько блоков
       return '<div id="over_slider">'.$new_rows[$show_item_number]['banner_text'].'</div>';
    }
}
  