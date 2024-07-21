<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Atualizar Erro: ' . $code;
?>
<div class="error-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="error-form">
        <?php $form = ActiveForm::begin(); ?>

        <p><strong>Código do Erro:</strong> <?= Html::encode($code) ?></p>
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
