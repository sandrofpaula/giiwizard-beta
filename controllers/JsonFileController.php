<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\JsonFile;
use app\models\Directory;
use yii\web\NotFoundHttpException;

class JsonFileController extends Controller
{
    public function actionIndex()
    {
        $directories = new Directory();
        $directoriesData = $directories->loadDirectories();

        /////////getDirectoryStructure///////
       // $path = \Yii::getAlias('@app/data/command');
       //$directory = Yii::$app->request->get('directory');
        //$directoryStructure = Directory::directoryStructure($path);
       // $directoryStructure = $directories->directoryStructure($path);
        ////fim getDirectoryStructure////////////

        $jsonFiles = [];
        foreach ($directoriesData['directories'] as $directory) {
            $path = Yii::getAlias($directory['path']);
            if (is_dir($path)) {
                $files = scandir($path);
                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                        $jsonFiles[] = [
                            'id' => count($jsonFiles) + 1,
                            'directory' => $directory['path'],
                            'name' => $file,
                            'path' => $path . '/' . $file,
                        ];
                    }
                }
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $jsonFiles,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'attributes' => ['id', 'name', 'directory'],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
           // 'directoryStructure' => $directoryStructure,
        ]);
    }

    public function actionCreate()
    {
        $model = new JsonFile();
        $directories = new Directory();
        $directoriesData = $directories->loadDirectories();
        $isNewRecord = true;
        $directory= $_GET["directory"];

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $filePath = Yii::getAlias($model->directory . '/' . $model->name);
            if (!preg_match('/\.json$/', $filePath)) {
                $filePath .= '.json';
            }
            if (file_put_contents($filePath, $model->content) !== false) {
                // return $this->redirect(['index']);
                return $this->redirect(['index-by-directory', 'directory' => $directory]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar o arquivo.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'directories' => $directoriesData['directories'],
            'isNewRecord' => $isNewRecord,
        ]);
    }

    public function actionUpdate($directory, $name)
    {
        $model = new JsonFile();
        $model->directory = $directory;
        $model->name = $name;
        $filePath = Yii::getAlias($directory . '/' . $name);
        $directory= $_GET["directory"];

        if (file_exists($filePath)) {
            $model->content = file_get_contents($filePath);
        } else {
            throw new NotFoundHttpException('O arquivo JSON não foi encontrado.');
        }

        $directories = new Directory();
        $directoriesData = $directories->loadDirectories();
        $isNewRecord = false;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (file_put_contents($filePath, $model->content) !== false) {
                // return $this->redirect(['index']);
                return $this->redirect(['index-by-directory', 'directory' => $directory]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar o arquivo.');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'directories' => $directoriesData['directories'],
            'isNewRecord' => $isNewRecord,
        ]);
    }

    public function actionDelete($directory, $name)
    {
        $filePath = Yii::getAlias($directory . '/' . $name);
        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
            throw new NotFoundHttpException('O arquivo JSON não foi encontrado.');
        }
        $directory= $_GET["directory"];
        // return $this->redirect(['index']);
        return $this->redirect(['index-by-directory', 'directory' => $directory]);
    }
    public function actionView($directory, $name)
    {
        $model = new JsonFile();
        $model->directory = $directory;
        $model->name = $name;
        $filePath = Yii::getAlias($directory . '/' . $name);

        if (file_exists($filePath)) {
            $model->content = file_get_contents($filePath);
        } else {
            throw new NotFoundHttpException('O arquivo JSON não foi encontrado.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionIndexByDirectory($directory)
    {
        $directories = new Directory();
        $directoriesData = $directories->loadDirectories();

        $jsonFiles = [];
        foreach ($directoriesData['directories'] as $dir) {
            if ($dir['path'] === $directory) {
                $path = Yii::getAlias($dir['path']);
                if (is_dir($path)) {
                    $files = scandir($path);
                    foreach ($files as $file) {
                        if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                            $jsonFiles[] = [
                                'id' => count($jsonFiles) + 1,
                                'directory' => $dir['path'],
                                'name' => $file,
                                'path' => $path . '/' . $file,
                            ];
                        }
                    }
                }
                break;
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $jsonFiles,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id', 'name', 'directory'],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
