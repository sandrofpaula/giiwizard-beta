<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Ícones Font Awesome ';
$this->params['breadcrumbs'][] = ['label' => 'Código Extra', 'url' => ['/site/codigoextra']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    #flash-message {
        position: fixed;
       /*  top: 20px; */
        top: 113.4px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        display: none;
        max-width: 90%;
        text-align: center;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


  <h1><?= Html::encode($this->title) ?></h1>
  <div id="flash-message" class="alert alert-primary"></div>
    <div class="alert alert-info">
        <p>Inclua no <b>inicio</b> da folha.</p>
        <div class="input-group mt-4">
            <input type="text" class="form-control" id="stylesheet-link-1" value='&lt;link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"&gt;' readonly>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary copy-button" type="button" onclick="copyCode2('stylesheet-link-1')">Copiar</button>
            </div>
        </div>
    </div>

    <div class="alert alert-secondary">
        <p>Inclua no <b>fim</b> da folha.</p>
        <div class="input-group mt-4">
            <input type="text" class="form-control" id="stylesheet-link-2" value='&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script&gt;' readonly>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary copy-button" type="button" onclick="copyCode2('stylesheet-link-2')">Copiar</button>
            </div>
        </div>
        <div class="input-group mt-4">
            <input type="text" class="form-control" id="stylesheet-link-3" value='&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script&gt;' readonly>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary copy-button" type="button" onclick="copyCode2('stylesheet-link-3')">Copiar</button>
            </div>
        </div>
    </div>

  <h1>Pesquisa de ícones Font Awesome </h1>
  <p>Clique no link abaixo para procurar por ícones de fonte impressionantes:</p>
  <a href="https://fontawesome.com/search?o=r&m=free" class="btn btn-warning" target="_blank">Pesquisa de ícones Font Awesome </a>

    
</div>
<!-- Optional JavaScript for interactive components -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>
    function copyCode2(elementId) {
        var codeElement = document.getElementById(elementId);
        var tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = codeElement.value.trim(); // Usar .value para input, .textContent para p
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        showFlashMessage('Copiado ' + tempInput.value);
    }

    function showFlashMessage(message) {
        var flashMessage = document.getElementById('flash-message');
        flashMessage.innerHTML = message;
        flashMessage.style.display = 'block';

        setTimeout(function() {
            flashMessage.style.display = 'none';
        }, 3000); // Esconde a mensagem após 3 segundos
    }
</script>
