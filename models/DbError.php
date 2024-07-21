<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class DbError extends Model
{
    public $code;
    public $name;
    public $message;
    public $categoria;
    public $bancoDeDados;

    private $configFile = '@app/web/data/db-error-codes.json';

    public function rules()
    {
        return [
            [['code', 'name', 'message', 'categoria', 'bancoDeDados'], 'required'],
            [['code'], 'string', 'max' => 10],
            [['name', 'message', 'categoria', 'bancoDeDados'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'Código do Erro',
            'name' => 'Nome',
            'message' => 'Mensagem',
            'categoria' => 'Categoria',
            'bancoDeDados' => 'Banco de Dados',
        ];
    }

    public function loadErrors()
    {
        $filePath = Yii::getAlias($this->configFile);
        if (!file_exists($filePath)) {
            return [];
        }
        return json_decode(file_get_contents($filePath), true);
    }

    public function saveErrors($errors)
    {
        $filePath = Yii::getAlias($this->configFile);
        file_put_contents($filePath, json_encode($errors, JSON_PRETTY_PRINT));
    }

    public function loadError($code)
    {
        $errors = $this->loadErrors();
        if (isset($errors[$code])) {
            $this->attributes = $errors[$code];
            $this->code = $code;
        }
    }

    public function saveError()
    {
        $errors = $this->loadErrors();
        $errors[$this->code] = $this->attributes;
        $this->saveErrors($errors);
    }

    public function deleteError($code)
    {
        $errors = $this->loadErrors();
        if (isset($errors[$code])) {
            unset($errors[$code]);
            $this->saveErrors($errors);
        }
    }
}
