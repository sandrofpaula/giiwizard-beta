<?php

namespace app\services;

class OtherCommandService
{
    private $filePath = '@app/web/data/other_commands.json';

    public function getAllCommands()
    {
        $json = file_get_contents(\Yii::getAlias($this->filePath));
        return json_decode($json, true);
    }

    public function saveAllCommands($commands)
    {
        $json = json_encode($commands, JSON_PRETTY_PRINT);
        file_put_contents(\Yii::getAlias($this->filePath), $json);
    }
}
