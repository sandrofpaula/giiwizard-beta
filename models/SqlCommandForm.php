<?php
namespace app\models;

use yii\base\Model;

class SqlCommandForm extends Model
{
    public $sql;
    public $results = []; // Inicializa a propriedade results como um array vazio

    public function rules()
    {
        return [
            [['sql'], 'required'],
            [['sql'], 'safe'],
        ];
    }
}
