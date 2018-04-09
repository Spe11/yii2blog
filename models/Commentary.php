<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commentaries".
 *
 * @property int $id
 * @property int $author_id
 * @property int $article
 * @property string $commentary
 * @property string $date
 *
 * @property Articles $article0
 */
class Commentary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commentaries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'article'], 'integer'],
            [['date'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['date'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['commentary'], 'string', 'max' => 1000],
            [['article'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => '',
            'article' => '',
            'commentary' => '',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle0()
    {
        return $this->hasOne(Articles::className(), ['id' => 'article']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}
