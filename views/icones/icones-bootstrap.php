<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Bootstrap Icons';
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?php echo Html::a('<i class="bi bi-bootstrap-fill"></i> Bootstrap Icons', 'https://icons.getbootstrap.com/', ['class' => 'btn btn-outline-primary', 'target' => '_blank']);?></p>
    </div>
    <!-- fica flutuando -->
    <div id="flash-message" class="alert alert-primary"></div>
    <!-- fim- fica flutuando -->
    <!-- <div id="flash-message" style="display:none; position:fixed; top:10px; right:10px; background:lightgrey; padding:10px; border-radius:5px;"></div> -->
    
    <p>Inclua a folha de estilo de fontes de ícone, no seu site ou via CSS.</p>
   <!--  <div class="row-cols-lg-2">
        <div class="alert alert-secondary mt-4" style="overflow: auto; max-height: 45px;">
            <p id="stylesheet-link-1" class="d-inline-block">&lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"&gt;</p>
            
    
            
        </div>  
        <a href="javascript:void(0);" class="btn-secondary" onclick="copyCode('stylesheet-link-1')"><i class="bi bi-clipboard"></i></a>
    </div>
 -->



    <div class="d-flex row-cols-lg-2 align-items-center mt-4">
        <div class="alert alert-secondary" style="overflow-x: auto; white-space: nowrap; max-height: 70px;">
            <p id="stylesheet-link-1" class="d-inline-block">
                &lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"&gt;
            </p>
        </div>
        <!-- <button class="btn btn-outline-secondary p-1" onclick="copyCode('stylesheet-link-1')"><i class="bi bi-clipboard"></i></button> -->
        <!-- <a href="javascript:void(0);" class="btn btn-outline-secondary p-1 inline-container" onclick="copyCode('stylesheet-link-1')"><i class="bi bi-clipboard"></i></a> -->
        <a href="javascript:void(0);" class="btn-secondary" style="margin-left: 20px;" onclick="copyCode('stylesheet-link-1')"><i class="bi bi-clipboard"></i></a>
    </div>

    <div class="input-group mt-4">
        <input type="text" class="form-control" id="stylesheet-link-3" value='&lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"&gt;' readonly>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary copy-button" type="button" onclick="copyCode2('stylesheet-link-3')">Copiar</button>
        </div>
    </div>

    

    <div class="alert alert-secondary mt-4 d-inline-block"  >
        <p id="stylesheet-link-2" class="d-inline-block row-cols-lg-2">
        Yii2 é excelente para desenvolvimento web devido à sua alta performance, 
        segurança robusta e flexibilidade.
        </p>
        
        <!-- <button class="btn btn-outline-secondary p-1" onclick="copyCode('stylesheet-link-2')"><i class="bi bi-clipboard"></i></button> -->
        <!-- <a href="javascript:void(0);" class="btn btn-outline-secondary p-1 inline-container" onclick="copyCode('stylesheet-link-2')"><i class="bi bi-clipboard"></i></a> -->
        
    </div>
    <a href="javascript:void(0);" class="btn-secondary" style="margin-left: 20px;" onclick="copyCode('stylesheet-link-2')"><i class="bi bi-clipboard"></i></a>


    <!-- <div class="input-group">
        <input type="text" class="form-control" id="stylesheet-link-3" value='&lt;link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"&gt;' readonly>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary copy-button" type="button" onclick="copyCode('stylesheet-link-3')">Copiar</button>
        </div>
    </div> -->


    



    <div class="alert alert-info">
        Clique no ícone abaixo para copiar o código do ícone para a área de transferência.
    </div>
    <div class="mb-3">
        <input type="text" id="iconSearchInput" class="form-control" placeholder="Digite para filtrar ícones...">
    </div>


    <div>
        <ul id="icons-list" class="row row-cols-3 row-cols-sm-4 row-cols-lg-6 row-cols-xl-8 list-unstyled list">
            <?php $iconNames = Yii::$app->controller->getIconNames(); ?>

            <?php foreach ($iconNames as $iconName): ?>
                <li class="col mb-4" data-name="<?= $iconName ?>" data-tags="icon" data-categories="icons">
                    <a class="d-block text-body-emphasis text-decoration-none" href="javascript:void(0);" onclick="copyIconCode('<i class=\'bi bi-<?= $iconName ?>\'></i>')">
                        <div class="px-3 py-4 mb-2 text-center rounded">
                            <h3> <i class="bi bi-<?= $iconName ?>"></i></h3>
                        </div>
                        <div class="name text-decoration-none text-center pt-1"><?= $iconName ?></div>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>
    
</div>

<script>
    document.getElementById('iconSearchInput').addEventListener('input', function() {
        var filter = this.value.toLowerCase();
        var icons = document.querySelectorAll('#icons-list li');

        icons.forEach(function(icon) {
            var iconName = icon.getAttribute('data-name').toLowerCase();
            if (iconName.includes(filter)) {
                icon.style.display = '';
            } else {
                icon.style.display = 'none';
            }
        });
    });

    function copyIconCode(iconCode) {
        var tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = iconCode;
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        
        showFlashMessage('Copiado: ' + iconCode);
    }
    function copyCode(elementId) {
        var codeElement = document.getElementById(elementId);
        var tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = codeElement.textContent.trim();
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

         showFlashMessage('Copiado: ' + tempInput.value);
    }

    function copyCode2(elementId) {
        var codeElement = document.getElementById(elementId);
        var tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = codeElement.value.trim(); // Usar .value para input, .textContent para p
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        showFlashMessage('Copiado: ' + tempInput.value);
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
