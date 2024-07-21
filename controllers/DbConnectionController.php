<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\DbConnection;
use yii\web\NotFoundHttpException;

class DbConnectionController extends Controller
{
    public function actionIndex()
    {
        $model = new DbConnection();
        $data = $model->loadConnections();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data['connections'],
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['name', 'dsn', 'username', 'charset', 'tablePrefix'],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'selected' => $data['selected'],
        ]);
    }

    public function actionCreate()
    {
        $model = new DbConnection();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = $model->loadConnections();
            $data['connections'][] = $model->attributes;
            $model->saveConnections($data);
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($name)
    {
        $model = new DbConnection();
        $data = $model->loadConnections();
        $connection = null;

        foreach ($data['connections'] as $index => $conn) {
            if ($conn['name'] === $name) {
                $connection = $conn;
                $connection['index'] = $index;
                break;
            }
        }

        if ($connection === null) {
            throw new NotFoundHttpException('Connection not found.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data['connections'][$connection['index']] = $model->attributes;
            $model->saveConnections($data);
            return $this->redirect(['index']);
        }

        $model->attributes = $connection;
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($name)
    {
        $model = new DbConnection();
        $data = $model->loadConnections();

        foreach ($data['connections'] as $index => $conn) {
            if ($conn['name'] === $name) {
                unset($data['connections'][$index]);
                break;
            }
        }

        $model->saveConnections($data);
        return $this->redirect(['index']);
    }

    public function actionSelect($name)
    {
        $model = new DbConnection();
        $data = $model->loadConnections();
        $data['selected'] = $name;
        $model->saveConnections($data);
        return $this->redirect(['index']);
    }
}
