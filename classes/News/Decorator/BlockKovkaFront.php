<?php
namespace News\Decorator;

class BlockKovkaFront extends News {
   public function renderReklamniyBlock(array $new_rows) {
       if(empty($new_rows)) {
           return '';
       }
       $show_item_number = rand(0, count($new_rows)-1);
       var_dump($new_rows[$show_item_number]);
    }
}
