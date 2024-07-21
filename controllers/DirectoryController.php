<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\Directory;
use yii\web\NotFoundHttpException;


class DirectoryController extends Controller
{
    public function actionIndex()
    {
        $model = new Directory();
        $data = $model->loadDirectories();
        /////////getDirectoryStructure///////
        $path = \Yii::getAlias('@app/web/data');
        $directoryStructure = Directory::directoryStructure($path);
        ////fim getDirectoryStructure////////////

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data['directories'],
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id', 'name', 'path'],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'directoryStructure' => $directoryStructure,
        ]);
    }
    


    /* public function actionCreate()
    {
        $model = new Directory();
        $isNewRecord = true;
        ////////////////
        $path = \Yii::getAlias('@app/web/data');
        $directoryStructure = Directory::directoryStructure($path);
        ////////////////

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = $model->loadDirectories();
            $model->id = $model->generateId($data);
            $data['directories'][] = $model->attributes;
            $model->saveDirectories($data);
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model, 'isNewRecord' => $isNewRecord, 'directoryStructure' => $directoryStructure]);
    } */
    public function actionCreate()
    {
        $model = new Directory();
        $isNewRecord = true;
    
        // Obtém a estrutura atual de diretórios
        $path = \Yii::getAlias('@app/web/data');
        $directoryStructure = Directory::directoryStructure($path);
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = $model->loadDirectories();
            $model->id = $model->generateId($data);
            $data['directories'][] = $model->attributes;
            $model->saveDirectories($data);
            
            // Cria o diretório no sistema de arquivos
            $newDirectoryPath = $path . DIRECTORY_SEPARATOR . $model->name;
            if (!is_dir($newDirectoryPath)) {
                mkdir($newDirectoryPath, 0755, true);
            }
    
            return $this->redirect(['index']);
        }
    
        return $this->render('create', [
            'model' => $model,
            'isNewRecord' => $isNewRecord,
            'directoryStructure' => $directoryStructure
        ]);
    }
    

    /* public function actionUpdate($id)
    {
        $model = new Directory();
        $data = $model->loadDirectories();
        $directory = null;
        ////////////////
        $path = \Yii::getAlias('@app/web/data');
        $directoryStructure =  Directory::directoryStructure($path);
        ////////////////

        foreach ($data['directories'] as $index => $dir) {
            // if ($dir['id'] === (int)$id) {
            if ((int)$dir['id'] === (int)$id) {
                $directory = $dir;
                $directory['index'] = $index;
                break;
            }
        }

        if ($directory === null) {
            throw new NotFoundHttpException('Directory not found.');
        }

        $isNewRecord = false;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data['directories'][$directory['index']] = $model->attributes;
            $model->saveDirectories($data);
            return $this->redirect(['index']);
        }

        $model->attributes = $directory;
        return $this->render('update', ['model' => $model, 'isNewRecord' => $isNewRecord, 'directoryStructure' => $directoryStructure]);
    } */
    public function actionUpdate($id)
    {
        $model = new Directory();
        $data = $model->loadDirectories();
        $directory = null;
        ////////////////
        $path = \Yii::getAlias('@app/web/data');
        $directoryStructure = Directory::directoryStructure($path);
        ////////////////
    
        foreach ($data['directories'] as $index => $dir) {
            if ((int)$dir['id'] === (int)$id) {
                $directory = $dir;
                $directory['index'] = $index;
                break;
            }
        }
    
        if ($directory === null) {
            throw new NotFoundHttpException('Directory not found.');
        }
    
        $isNewRecord = false;
    
        $oldDirectoryName = $directory['name'];
        $oldDirectoryPath = $path . DIRECTORY_SEPARATOR . $oldDirectoryName;
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data['directories'][$directory['index']] = $model->attributes;
            $model->saveDirectories($data);
    
            // Renomeia o diretório no sistema de arquivos se o nome tiver sido alterado
            $newDirectoryName = $model->name;
            $newDirectoryPath = $path . DIRECTORY_SEPARATOR . $newDirectoryName;
            if ($oldDirectoryName !== $newDirectoryName) {
                if (is_dir($oldDirectoryPath)) {
                    rename($oldDirectoryPath, $newDirectoryPath);
                }
            }
    
            return $this->redirect(['index']);
        }
    
        $model->attributes = $directory;
        return $this->render('update', [
            'model' => $model,
            'isNewRecord' => $isNewRecord,
            'directoryStructure' => $directoryStructure
        ]);
    }
    

    /* public function actionDelete($id)
    {
        $model = new Directory();
        $data = $model->loadDirectories();

        foreach ($data['directories'] as $index => $dir) {
            if ($dir['id'] === (int)$id) {
                unset($data['directories'][$index]);
                break;
            }
        }

        $model->saveDirectories($data);
        return $this->redirect(['index']);
    } */
    public function actionDelete($id)
    {
        $model = new Directory();
        $data = $model->loadDirectories();
        $directoryName = null;
    
        // Obtém a estrutura atual de diretórios
        $path = \Yii::getAlias('@app/web/data');
    
        foreach ($data['directories'] as $index => $dir) {
            if ((int)$dir['id'] === (int)$id) {
                $directoryName = $dir['name'];
                unset($data['directories'][$index]);
                break;
            }
        }
    
        if ($directoryName !== null) {
            $directoryPath = $path . DIRECTORY_SEPARATOR . $directoryName;
            if (is_dir($directoryPath)) {
                $this->deleteDirectory($directoryPath);
            }
        }
    
        $model->saveDirectories($data);
        return $this->redirect(['index']);
    }
    
    private function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return false;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!self::deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
    
        return rmdir($dir);
    }
    
    public function actionViewFile($path)
    {
        $filePath = Yii::getAlias($path);
        if (!file_exists($filePath)) {
            throw new NotFoundHttpException('Arquivo não encontrado.');
        }

        $content = file_get_contents($filePath);
        return $this->render('view-file', [
            'content' => $content,
            'path' => $filePath,
        ]);
    }
}
