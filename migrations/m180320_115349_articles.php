<?php

use yii\db\Migration;

/**
 * Class m180320_115349_articles
 */
class m180320_115349_articles extends Migration
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
        echo "m180320_115349_articles cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('articles',[
            'id' => $this->primaryKey(),
            'title' => $this->string(200),
            'content' => $this->string(2000),
            'author_id' => $this->integer(),
            'date' => $this->date("Y-m-d H:i:s"),
            'hits' => $this->integer(),
            'picture' => $this->string(200)
        ]);
    }

    public function down()
    {
        $this->dropTable('articles');
    }
   
}
