<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Criar Novo Erro';
?>
<div class="error-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="error-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'code')->textInput()->label('Código do Erro') ?>
        <?= $form->field($model, 'name')->textInput()->label('Nome') ?>
        <?= $form->field($model, 'message')->textInput()->label('Mensagem') ?>
        <?= $form->field($model, 'categoria')->textInput()->label('Categoria') ?>
        <?= $form->field($model, 'bancoDeDados')->textInput()->label('Banco de Dados') ?>

        <div class="form-group">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
