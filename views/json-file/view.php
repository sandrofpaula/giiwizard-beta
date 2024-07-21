<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = 'Visualizar Arquivo JSON: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Arquivo JSON', 'url' => ['index-by-directory','directory'=>$_GET["directory"]]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// Registrar arquivos CSS e JS do JSONEditor
$this->registerCssFile('https://cdn.jsdelivr.net/npm/jsoneditor@9.5.6/dist/jsoneditor.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/jsoneditor@9.5.6/dist/jsoneditor.min.js');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/ace-builds/src-min-noconflict/theme-cobalt.js');

$directory= $_GET["directory"];
?>
<div class="json-file-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Atualizar', ['update', 'directory' => $model->directory, 'name' => $model->name], ['class' => 'btn btn-primary']) ?></p>

    <!-- Hidden textarea to hold the content -->
    <?= Html::activeTextarea($model, 'content', ['id' => 'json-content', 'style' => 'display:none;']) ?>

    <!-- Div for JSON Editor -->
    <div id="json-editor" style="  display: flex; height: 400px; width: 100%;"></div>
    <!-- <div id="json-editor" style="  display: flex; height: 900px; align-items: center;"></div> -->

    <?php
    $script = <<< JS
    var container = document.getElementById("json-editor");
    var options = {
        mode: 'code', // Modo de visualização
        modes: ['code', 'form', 'text', 'tree', 'view', 'preview'], // Modos permitidos
        theme: 'ace/theme/cobalt', // Tema escuro
        onError: function (err) {
            alert(err.toString());
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
    JS;
    $this->registerJs($script);
    ?>
</div>
