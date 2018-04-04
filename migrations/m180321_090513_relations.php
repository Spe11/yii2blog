<?php

use yii\db\Migration;

/**
 * Class m180321_090513_relations
 */
class m180321_090513_relations extends Migration
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
        echo "m180321_090513_relations cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createIndex(
            'idx-articles-author_id',
            'articles',
            'author_id'
        );

        $this->createIndex(
            'idx-articles-category',
            'articles',
            'category'
        );  

        $this->createIndex(
            'idx-commentaries-author_id',
            'commentaries',
            'author_id'
        );
        
        $this->createIndex(
            'idx-commentaries-article',
            'commentaries',
            'article'
        );

        $this->addForeignKey(
            'fk-articles-author_id',
            'articles',
            'author_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-articles-category',
            'articles',
            'category',
            'categories',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-commentaries-author_id',
            'commentaries',
            'author_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-commentaries-article',
            'commentaries',
            'article',
            'articles',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-articles-author_id',
            'articles'
        );

        $this->dropIndex(
            'idx-articles-author_id',
            'articles'
        );

        $this->dropForeignKey(
            'fk-articles-category',
            'articles'
        );

        $this->dropIndex(
            'idx-articles-category',
            'articles'
        );

        $this->dropForeignKey(
            'fk-commentaries-author_id',
            'commentaries'
        );

        $this->dropIndex(
            'fk-commentaries-article',
            'commentaries'
        );

        $this->dropForeignKey(
            'fk-articles-author_id',
            'commentaries'
        );

        $this->dropIndex(
            'idx-articles-article',
            'commentaries'
        );
    }
}
