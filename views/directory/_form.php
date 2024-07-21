<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Directory */
/* @var $form yii\widgets\ActiveForm */
/* @var $isNewRecord boolean */

?>

<div class="directory-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php include 'modal/view_diretorios.php'; ?>

    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => true, 'value' => $isNewRecord ? '@app/web/data/' : $model->path]) ?>

    <div class="form-group">
        <?= Html::submitButton($isNewRecord ? 'Criar' : 'Atualizar', ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
