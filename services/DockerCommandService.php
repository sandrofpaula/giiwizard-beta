<?php

namespace app\services;

use Yii;
use yii\helpers\Json;

class DockerCommandService
{
    private $filePath;

    public function __construct()
    {
        // $this->filePath = Yii::getAlias('@app/web/data/git_commands.json');
        $this->filePath = Yii::getAlias('@app/web/data/docker_commands.json');
    }

    public function getAllCommands()
    {
        if (file_exists($this->filePath)) {
            $json = file_get_contents($this->filePath);
            return Json::decode($json);
        }
        return [];
    }

    public function saveAllCommands($commands)
    {
        $json = Json::encode($commands);
        file_put_contents($this->filePath, $json);
    }
}
