<?php

use yii\db\Migration;

/**
 * Class m180414_153725_addtoken
 */
class m180414_153725_addtoken extends Migration
{
    /**
     * {@inheritdoc}
     */
    /* public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    /* public function safeDown()
    {
        echo "m180414_153725_addtoken cannot be reverted.\n";

        return false;
    } */

    public function up()
    {
        $this->addColumn('users', 'token',  $this->string(255));
    }

    public function down()
    {
        $this->dropColumn('users', 'token');
    }
}
