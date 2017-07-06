<?php

use yii\db\Migration;

class m170706_093516_add_subcategory_to_catalog extends Migration
{
    public function up()
    {
        $this->addColumn('catalog', 'subcategory_id', $this->integer(11)->notNull());
    }

    public function down()
    {
        echo "m170706_093516_add_subcategory_to_catalog cannot be reverted.\n";

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
