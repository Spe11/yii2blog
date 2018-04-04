<?php

use yii\db\Migration;

/**
 * Class m180321_084012_users
 */
class m180321_084012_users extends Migration
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
        echo "m180321_084012_users cannot be reverted.\n";

        return false;
    }

   // Use up()/down() to run migration code without a transaction.
   public function up()
   {
       $this->createTable('users',[
           'id' => $this->primaryKey(),
           'username' => $this->string(20),
           'authKey' => $this->string(255),
           'password' => $this->string(255),
       ]);
   }

   public function down()
   {
       $this->dropTable('users');
   }
}
