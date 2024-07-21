<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
class Directory extends Model
{
    public $id;
    public $name;
    public $path;

    private $configFile = '@app/web/data/directories.json';

    public function rules()
    {
        return [
            [['name', 'path'], 'required'],
            [['id'], 'integer'],
            [['name', 'path'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'path' => 'Caminho',
        ];
    }

    public function loadDirectories()
    {
        $filePath = Yii::getAlias($this->configFile);
        if (!file_exists($filePath)) {
            return ['directories' => []];
        }
        return json_decode(file_get_contents($filePath), true);
    }

    public function saveDirectories($data)
    {
        $filePath = Yii::getAlias($this->configFile);
        // Certifique-se de que os IDs sejam salvos como inteiros
        foreach ($data['directories'] as &$directory) {
            $directory['id'] = (int)$directory['id'];
        }
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    public function generateId($directories)
    {
        $ids = array_column($directories['directories'], 'id');
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
//,'*.html', '*.md', '*.php', '*.js', '*.css'
    $files = FileHelper::findFiles($path, ['only' => ['*.json'], 'recursive' => false]);
    foreach ($files as $file) {
        $structure[] = [
            'name' => basename($file),
            'path' => $file, // Adiciona o caminho completo do arquivo
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
