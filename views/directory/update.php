<?php
use yii\helpers\Html;

$this->title = 'Atualizar Diretório: ' . $model->name;
?>
<div class="directory-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model,'directoryStructure' => $directoryStructure]) ?>
</div>
