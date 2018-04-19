<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Image extends Model {
    public $path;
    public $image;

    public function __construct() {
        $this->path = Yii::getAlias('@web').'/uploads/';
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

    private function generateNameFromBase64s($base64) {
        $name = substr($base64, -10);
        $extension = substr($base64, 11, 3);
        return md5(uniqid($name)).'.'.$extension;
    }

    private function deleteExisted($article) {
        if($article->picture !== null) {
            unlink($this->path.$article->picture);
        }
    }

    private function createDir() {
        if (!file_exists($this->path)) {
            mkdir($this->path);
        }
    }

    public function upload($file, $article) {
        $this->createDir();
        $this->deleteExisted($article);
        $name = $this->generateName($file);
        $file->saveAs($this->path.$name);
        $article->picture = $name;
        $article->save(false);
    }

    public function uploadFromBase64($base64, $article) {
        $this->createDir();
        $this->deleteExisted($article);
        $name = $this->generateNameFromBase64s($base64);
        $file = fopen($this->path.$name, 'wb');
        $data = explode(',', $base64);
        fwrite($file, base64_decode($data[1]));
        fclose($file);
        $article->picture = $name;
        $article->save(false);
    }
}
