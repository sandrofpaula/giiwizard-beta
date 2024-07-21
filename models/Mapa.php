<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;

/**
 * This is the model class for JSON data stored in "web/data/db-mapa.json".
 */
class Mapa extends Model
{
    public $id;
    public $nome;
    public $endereco;
    public $localizacao;

    private static $filePath = '@app/web/data/db-mapa.json';

    public static function tableName()
    {
        return 'mapa';
    }

    public function rules()
    {
        return [
            [['id', 'nome', 'endereco', 'localizacao'], 'required'],
            [['id'], 'integer'],
            [['nome', 'endereco', 'localizacao'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'endereco' => 'Endereço',
            'localizacao' => 'Localização',
        ];
    }

    public static function findAll()
    {
        $file = Yii::getAlias(self::$filePath);
        $data = Json::decode(file_get_contents($file), true);
        $models = [];
        foreach ($data as $item) {
            $models[] = new self($item);
        }
        return $models;
    }

    public static function findOne($id)
    {
        $file = Yii::getAlias(self::$filePath);
        $data = Json::decode(file_get_contents($file), true);
        foreach ($data as $item) {
            if ($item['id'] == $id) {
                return new self($item);
            }
        }
        return null;
    }

    public function save()
    {
        $file = Yii::getAlias(self::$filePath);
        $data = Json::decode(file_get_contents($file), true);
        if ($this->id) {
            foreach ($data as $index => $item) {
                if ($item['id'] == $this->id) {
                    $data[$index] = $this->attributes;
                }
            }
        } else {
            $this->id = count($data) + 1;
            $data[] = $this->attributes;
        }
        return file_put_contents($file, Json::encode($data));
    }

    public function delete()
    {
        $file = Yii::getAlias(self::$filePath);
        $data = Json::decode(file_get_contents($file), true);
        foreach ($data as $index => $item) {
            if ($item['id'] == $this->id) {
                unset($data[$index]);
                break;
            }
        }
        return file_put_contents($file, Json::encode(array_values($data)));
    }
}
