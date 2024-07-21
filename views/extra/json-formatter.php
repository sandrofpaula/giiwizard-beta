<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'JSON Formatter';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

<div class="json-formatter">

    <?php $form = ActiveForm::begin(); ?>

    <p>Validador e formatador JSON</p>
    <p>Valide e formate sua cadeia de caracteres de JSON em uma árvore de objeto </p>

    <?= $form->field($model, 'json')->textarea(['rows' => 10, 'cols' => 50, 'id' => 'json-textarea']) ?>

    <div class="form-group">
        <?= Html::submitButton('Format JSON', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php if ($formattedJson !== null): ?>
        <h2>Formatted JSON:</h2>
        <pre id="formatted-json"><?= Html::encode($formattedJson) ?></pre>
        <?= Html::button('Copiar Conteúdo', ['class' => 'btn btn-secondary', 'id' => 'copy-button']) ?>
    <?php endif; ?>

    <div id="flash-message" style="display: none; background-color: #d4edda; padding: 10px; margin-top: 10px; border: 1px solid #c3e6cb; border-radius: 5px;">
        <!-- Flash message content will be inserted here -->
    </div>
</div>

<script>
    document.getElementById('copy-button').addEventListener('click', function() {
        var targetElement = document.getElementById('formatted-json');

        // Cria um textarea temporário
        var tempTextarea = document.createElement('textarea');
        tempTextarea.value = targetElement.textContent;
        document.body.appendChild(tempTextarea);

        // Seleciona e copia o conteúdo do textarea temporário
        tempTextarea.select();
        document.execCommand('copy');

        // Remove o textarea temporário
        document.body.removeChild(tempTextarea);

        showFlashMessage('Conteúdo copiado!');
    });

    function showFlashMessage(message) {
        var flashMessage = document.getElementById('flash-message');
        flashMessage.innerHTML = message;
        flashMessage.style.display = 'block';

        setTimeout(function() {
            flashMessage.style.display = 'none';
        }, 3000); // Esconde a mensagem após 3 segundos
    }
</script>
