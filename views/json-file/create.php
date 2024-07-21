<?php
use yii\helpers\Html;
$directory= $_GET["directory"];
$this->title = 'Criar Novo Arquivo JSON';
$this->params['breadcrumbs'][] = ['label' => 'Arquivo JSON', 'url' => ['index-by-directory', 'directory' => $directory]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="json-file-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'directories' => $directories,
        'isNewRecord' => true,
    ]) ?>
</div>
