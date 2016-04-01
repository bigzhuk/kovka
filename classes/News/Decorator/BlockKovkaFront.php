<?php
namespace News\Decorator;

class BlockKovkaFront extends News {
   public function renderReklamniyBlock(array $new_rows) {
       if(empty($new_rows)) {
           return 'Все весну на кованные навесы скидка – 30%';
       }
       $show_item_number = rand(0, count($new_rows)-1);
       return ($new_rows[$show_item_number]['full_text']);
    }
}
