<?php

use yii\db\Migration;

/**
 * Class m180321_083818_categories
 */
class m180321_083818_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180321_083818_categories cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('categories',[
            'id' => $this->primaryKey(),
            'name' => $this->string(20),
        ]);
    }

    public function down()
    {
        $this->dropTable('categories');
    }
   
}
