<?php

use yii\db\Migration;

/**
 * Class m180321_085100_commentaries
 */
class m180321_085100_commentaries extends Migration
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
        echo "m180321_085100_commentaries cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('commentaries',[
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'article' => $this->integer(),
            'commentary' => $this->string(1000),
            'date' => $this->date("Y-m-d H:i:s")
        ]);
    }
 
    public function down()
    {
        $this->dropTable('commentaries');
    }
}
