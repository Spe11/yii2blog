<?php
namespace app\models;

use Yii;
use yii\base\Model;


class Image extends Model {
    public $path;
    public $image;

    public function __construct() {
        $path = Yii::getAlias('@webroot').'/uploads/';
    }

    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image' => 'Изображение',
        ];
    }

    private function generateName($file) {
        return md5(uniqid($file->name)).'.'.$file->extension;
    }

    private function deleteExisted($article) {
        if($article->picture !== null) {
            unlink(Yii::getAlias('@webroot') . '/uploads/'. $article->picture);
        }
    }

    public function upload($file, $article) { 
        $this->deleteExisted($article);
        $name = $this->generateName($file);
        $file->saveAs(Yii::getAlias('@webroot').'/uploads/'.$name);
        $article->picture = $name;
        $f = $article->save();
    }
}