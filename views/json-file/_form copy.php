<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\JsonFile */
/* @var $form yii\widgets\ActiveForm */
/* @var $isNewRecord boolean */
/* @var $directories array */

$this->registerCssFile('https://cdn.jsdelivr.net/npm/jsoneditor@9.5.6/dist/jsoneditor.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/jsoneditor@9.5.6/dist/jsoneditor.min.js');

$this->registerJsFile('https://cdn.jsdelivr.net/npm/ace-builds/src-min-noconflict/theme-cobalt.js');
$directory= $_GET["directory"];
?>

<div class="json-file-form">

    <?php $form = ActiveForm::begin(); ?>
 <?php 
/*  echo  $form->field($model, 'directory')->dropDownList(
        ArrayHelper::map($directories, 'path', 'name'),
        [
            'prompt' => 'Selecione um Diretório',
            'options' => [
                $directory => ['Selected' => true]
            ]
        ]
    )  */
    ?>
    <?= $form->field($model, 'directory')->hiddenInput(['value' => $directory])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- Hidden textarea to hold the content -->
    <?= Html::activeTextarea($model, 'content', ['id' => 'json-content', 'style' => 'display:none;']) ?>

    <!-- Div for JSON Editor -->
    <div id="json-editor" style="height: 400px; width: 100%;"></div>

    <!-- Button to format JSON -->
    <div class="form-group">
        <?= Html::button('Formatar JSON', ['class' => 'btn btn-secondary', 'id' => 'format-json-button']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($isNewRecord ? 'Criar' : 'Atualizar', ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
var container = document.getElementById("json-editor");
var options = {
    mode: 'code', // Modo de visualização
    modes: ['code', 'form', 'text', 'tree', 'view', 'preview'], // Modos permitidos
    theme: 'ace/theme/cobalt', // Tema escuro
    onError: function (err) {
        alert(err.toString());
    },
    onModeChange: function (newMode, oldMode) {
        console.log('Mode switched from', oldMode, 'to', newMode);
    }
};
var editor = new JSONEditor(container, options);

// Set initial content from hidden textarea
var initialContent = $('#json-content').val();
if (initialContent.trim() === '') {
    initialContent = '{}'; // Default to an empty JSON object if initial content is empty
}
try {
    editor.set(JSON.parse(initialContent));
} catch (e) {
    editor.setText('{"error": "Invalid JSON"}');
}

// Function to format JSON
function formatJson(json) {
    try {
        var parsed = JSON.parse(json);
        return JSON.stringify(parsed, null, 4);
    } catch (e) {
        return 'Invalid JSON: ' + e.message;
    }
}

// Automatically format JSON on page load
$('#json-content').val(formatJson(editor.getText()));

// Event listener for the format button
$('#format-json-button').click(function() {
    var content = editor.getText();
    var formatted = formatJson(content);
    editor.setText(formatted);
});

// Update the hidden textarea before form submission
$('form').submit(function() {
    $('#json-content').val(JSON.stringify(editor.get()));
});
JS;
$this->registerJs($script);
?>
