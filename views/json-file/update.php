<?php
use yii\helpers\Html;
$directory= $_GET["directory"];
$this->title = 'Visualizar Arquivo JSON: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Arquivo JSON', 'url' => ['index-by-directory', 'directory' => $directory]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="json-file-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'directories' => $directories,
        'isNewRecord' => false,
    ]) ?>
</div>
