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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'directory-name']) ?>

    <?= $form->field($model, 'path')->hiddenInput(['maxlength' => true, 'id' => 'directory-path', 'value' => $isNewRecord ? '@app/web/data/' : $model->path])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton($isNewRecord ? 'Criar' : 'Atualizar', ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
document.getElementById('directory-name').addEventListener('input', function() {
    var basePath = '@app/web/data/';
    var name = this.value;
    document.getElementById('directory-path').value = basePath + name;
});
</script>