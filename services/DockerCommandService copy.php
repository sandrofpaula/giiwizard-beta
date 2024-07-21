<?php

namespace app\services;

class DockerCommandService
{
    private $filePath = '@app/web/data/docker_commands.json';

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

    public function getCommandById($id)
    {
        $commands = $this->getAllCommands();
        foreach ($commands as $command) {
            if ($command['id'] == $id) {
                return $command;
            }
        }
        return null;
    }

    public function createCommand($newCommand)
    {
        $commands = $this->getAllCommands();
        $newCommand['id'] = end($commands)['id'] + 1;
        $commands[] = $newCommand;
        $this->saveAllCommands($commands);
    }

    public function updateCommand($id, $updatedCommand)
    {
        $commands = $this->getAllCommands();
        foreach ($commands as &$command) {
            if ($command['id'] == $id) {
                $command = array_merge($command, $updatedCommand);
                $this->saveAllCommands($commands);
                return;
            }
        }
    }

    public function deleteCommand($id)
    {
        $commands = $this->getAllCommands();
        $commands = array_filter($commands, function($command) use ($id) {
            return $command['id'] != $id;
        });
        $this->saveAllCommands($commands);
    }
}
