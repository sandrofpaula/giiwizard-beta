<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\DbError;

class ErrorController extends Controller
{
    public function actionIndex()
    {
        $model = new DbError();
        $errors = $model->loadErrors();
        return $this->render('index', ['errors' => $errors]);
    }

    public function actionCreate()
    {
        $model = new DbError();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->saveError();
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($code)
    {
        $model = new DbError();
        $model->loadError($code);

        if (!$model->code) {
            throw new NotFoundHttpException('Error code not found.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->saveError();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'code' => $code
        ]);
    }

    public function actionDelete($code)
    {
        $model = new DbError();
        $model->deleteError($code);
        return $this->redirect(['index']);
    }
}
