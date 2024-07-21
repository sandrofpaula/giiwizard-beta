<?php
namespace app\models;

use yii\base\Model;
use yii\helpers\Json;

class Command extends Model
{
    public $id;
    public $command;
    public $description;
    public $category;
    public $favorite;

    private static $filePath;

    public static function setFilePath($filePath)
    {
        self::$filePath = $filePath;
    }

    public function rules()
    {
        return [
            [['command', 'description', 'category'], 'required'],
            [['command', 'description', 'category'], 'string', 'max' => 255],
            [['favorite'], 'boolean'],
        ];
    }

    public function toCommandArray()
    {
        return [
            'id' => $this->id,
            'command' => $this->command,
            'description' => $this->description,
            'category' => $this->category,
            'favorite' => $this->favorite ? true : false,
        ];
    }

    public static function findAll()
    {
        if (file_exists(self::$filePath)) {
            $data = Json::decode(file_get_contents(self::$filePath), true);
            return $data;
        }
        return [];
    }

    public static function findOne($id)
    {
        $commands = self::findAll();
        foreach ($commands as $command) {
            if ($command['id'] == $id) {
                $model = new self();
                $model->id = $command['id'];
                $model->command = $command['command'];
                $model->description = $command['description'];
                $model->category = $command['category'];
                $model->favorite = $command['favorite'];
                return $model;
            }
        }
        return null;
    }

    public function delete()
    {
        $commands = self::findAll();
        foreach ($commands as $index => $command) {
            if ($command['id'] == $this->id) {
                unset($commands[$index]);
                file_put_contents(self::$filePath, Json::encode(array_values($commands), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                return true;
            }
        }
        return false;
    }
}
