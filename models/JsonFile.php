<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
class JsonFile extends Model
{
    public $id;
    public $directory;
    public $name;
    public $content;

    public function rules()
    {
        return [
            [['directory', 'name', 'content'], 'required'],
            [['id'], 'integer'],
            [['directory', 'name'], 'string', 'max' => 255],
            [['content'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'directory' => 'Diretório',
            'name' => 'Nome do Arquivo',
            'content' => 'Conteúdo',
        ];
    }

    public function getFilePath()
    {
        return Yii::getAlias($this->directory . '/' . $this->name);
    }

    public function loadFileContent()
    {
        $filePath = $this->getFilePath();
        if (!file_exists($filePath)) {
            return null;
        }
        $this->content = file_get_contents($filePath);
        return $this->content;
    }

    public function saveFileContent()
    {
        $filePath = $this->getFilePath();
        return file_put_contents($filePath, $this->content);
    }

    public function generateId($jsonFiles)
    {
        $ids = array_column($jsonFiles, 'id');
        return empty($ids) ? 1 : max($ids) + 1;
    }
     ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     public static function directoryStructure($path)
     {
         $structure = [];
         $directories = FileHelper::findDirectories($path, ['recursive' => false]);
         foreach ($directories as $directory) {
             $structure[] = [
                 'name' => basename($directory) . '/',
                 'icon' => 'fas fa-folder-open',
                 'colorClass' => 'folder-color',
                 'children' => self::directoryStructure($directory)
             ];
         }
 
         $files = FileHelper::findFiles($path, ['only' => ['*.json'], 'recursive' => false]);
         foreach ($files as $file) {
             $structure[] = [
                 'name' => basename($file),
                 'icon' => self::getIconForFile($file),
                 'colorClass' => self::getColorClassForFile($file)
             ];
         }
 
         return $structure;
     }
 
     private static function getIconForFile($file)
     {
         $extension = pathinfo($file, PATHINFO_EXTENSION);
         switch ($extension) {
             case 'php':
                 return 'fab fa-php';
             case 'json':
                 return 'fas fa-file-alt';
             case 'html':
                 return 'fab fa-html5';
             case 'md':
                 return 'fas fa-file-alt';
             default:
                 return 'fas fa-file';
         }
     }
 
     private static function getColorClassForFile($file)
     {
         $extension = pathinfo($file, PATHINFO_EXTENSION);
         switch ($extension) {
             case 'php':
                 return 'php-file-color';
             case 'json':
                 return 'json-file-color';
             case 'html':
                 return 'html-file-color';
             case 'md':
                 return 'md-file-color';
             default:
                 return 'default-file-color';
         }
     }
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
