<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Criar Nova Conexão';
?>
<div class="db-connection-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="db-connection-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput()->label('Nome') ?>
        <?= $form->field($model, 'dsn')->textInput()->label('DSN') ?>
        <?= $form->field($model, 'username')->textInput()->label('Nome de Usuário') ?>
        <!-- <?= $form->field($model, 'password')->passwordInput()->label('Senha') ?> -->
        <?= $form->field($model, 'password')->textInput()->label('Senha') ?>
        <?= $form->field($model, 'charset')->textInput()->label('Charset') ?>
        <?= $form->field($model, 'tablePrefix')->textInput()->label('Prefixo da Tabela') ?>

        <div class="form-group">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
