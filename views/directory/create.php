<?php
use yii\helpers\Html;

$this->title = 'Criar Novo Diretório';
?>
<div class="directory-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isNewRecord' => true, 'directoryStructure' => $directoryStructure]) ?>
</div>
