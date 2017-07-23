<?php

use yii\db\Migration;

class m170721_150121_add_main_photo_number_tocatalog extends Migration
{
    public function up()
    {
        $this->addColumn('catalog', 'main_photo_number', $this->smallInteger(4)->notNull());
    }

    public function down()
    {
        echo "m170721_150121_add_main_photo_number_tocatalog cannot be reverted.\n";

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
