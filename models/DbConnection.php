<?php

namespace app\models;

use Yii;
use yii\base\Model;

class DbConnection extends Model
{
    public $name;
    public $dsn;
    public $username;
    public $password;
    public $charset;
    public $tablePrefix;

    private $configFile = '@app/web/data/db-connections.json';
    private $errorCodesFile = '@app/web/data/db-error-codes.json';

    public function rules()
    {
        return [
            [['name', 'dsn', 'username', 'charset'], 'required'],
            [['name', 'dsn', 'username', 'password', 'charset', 'tablePrefix'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nome',
            'dsn' => 'DSN',
            'username' => 'Nome de Usuário',
            'password' => 'Senha',
            'charset' => 'Charset',
            'tablePrefix' => 'Prefixo da Tabela',
        ];
    }

    public function loadConnections()
    {
        $filePath = Yii::getAlias($this->configFile);
        if (!file_exists($filePath)) {
            return [];
        }
        return json_decode(file_get_contents($filePath), true);
    }

    public function saveConnections($data)
    {
        $filePath = Yii::getAlias($this->configFile);
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    public function loadErrorCodes()
    {
        $filePath = Yii::getAlias($this->errorCodesFile);
        if (!file_exists($filePath)) {
            return [];
        }
        return json_decode(file_get_contents($filePath), true);
    }
}
