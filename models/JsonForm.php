<?php

namespace app\models;

use yii\base\Model;

class JsonForm extends Model
{
    public $json;

    public function rules()
    {
        return [
            [['json'], 'required'],
            [['json'], 'validateJson'],
        ];
    }

    public function validateJson($attribute, $params)
    {
        $decoded = json_decode($this->json, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            $this->addError($attribute, 'Invalid JSON: ' . json_last_error_msg());
        }
    }
}
