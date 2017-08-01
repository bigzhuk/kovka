<?php

use app\models\Catalog;
use yii\db\Migration;

class m170801_080234_fill_price_int_with_data extends Migration
{
    public function up()
    {
        $prices = Catalog::find()
            ->select('id, price')
            ->orderBy('id ASC')
            ->asArray()
            ->all();

        foreach ($prices as $price) {
            $int_price =  (int)preg_replace('/[^0-9]+/', '', $price['price']);
            $sql = 'UPDATE catalog SET price_int = '.$int_price.' WHERE id='.$price['id'];
            $this->execute($sql);
        }

    }

    public function down()
    {
        echo "m170801_080234_fill_price_int_with_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
