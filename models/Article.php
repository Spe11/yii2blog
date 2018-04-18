<?php

namespace app\models;

use Yii;
use app\models\Users;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $author_id
 * @property string $date
 * @property int $hits
 * @property resource $picture
 * @property int $category
 *
 * @property Users $author
 * @property Categories $category0
 * @property Commentaries[] $commentaries
 */
class Article extends \yii\db\ActiveRecord
{
    public $query;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'hits', 'category'], 'integer'],
            [['title', 'content', 'author_id', 'category'], 'required'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 200],
            [['content'], 'string', 'max' => 2000],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержание',
            'author_id' => 'Автор',
            'date' => 'Дата',
            'hits' => 'Hits',
            'picture' => 'Picture',
            'category' => 'Категория',
        ];
    }

    public function fields()
    {
        return [
            'Идентификатор' => 'id',
            'Заголовок' => 'title',
            'Содержание' => 'content',
            'Автор' => 'author_id',
            'Дата' => 'date',
            'Картинка' => 'picture',
            'Категория' => 'category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentaries()
    {
        return $this->hasMany(Commentary::className(), ['article' => 'id']);
    }

    public function getAuthors()
    {
        return ArrayHelper::map(User::find()->all(),'id','username');
    }

    public function getDescription()
    {
        return substr($this->content, 0, 200);
    }

    public function getImage() {
        return Yii::getAlias('@web').'/web/uploads/'.$this->picture;
    }
}
