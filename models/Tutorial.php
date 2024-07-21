<?php

namespace app\models;

use yii\base\Model;
use Yii;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

class Tutorial extends Model
{
    public $id;
    public $nome;
    public $arquivo;
    public $titulo;

    public static function findById($id)
    {
        $jsonPath = Yii::getAlias('@app/web/data/db-tutorial.json');
        if (file_exists($jsonPath)) {
            $json = file_get_contents($jsonPath);
            $data = Json::decode($json, true);

            if ($data === null) {
                throw new \yii\web\HttpException(500, 'Erro ao decodificar JSON');
            }

            foreach ($data as $item) {
                if ($item['id'] == $id) {
                    return new static($item);
                }
            }
        }

        return null; // Se não encontrar o ID
    }
}
