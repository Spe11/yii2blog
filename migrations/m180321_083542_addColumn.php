<?php

use yii\db\Migration;

/**
 * Class m180321_083542_addColumn
 */
class m180321_083542_addColumn extends Migration
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
        echo "m180321_083542_addColumn cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('articles', 'category', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('post', 'category');
    }
   
}
