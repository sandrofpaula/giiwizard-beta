<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Com Módulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<!---->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            display: none;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="site-about">
        <h1 class="modal-title"><span class="badge bg-danger">Gii Wizard</span></h1>
        
        <h2>Banco de Dados: Personalizado</h2>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exemplojson">
            <i class="fas fa-info-circle"></i> Exemplo JSON
        </button>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#listaTable">
            <i class="fas fa-info-circle"></i> Listar todas as tabelas de um banco de dados em MySQL e Oracle
        </button>
        
        <p class="d-inline-block"><?php echo Html::a('Json Formatter', ['/site/json-formatter'], ['class' => 'btn btn-outline-primary', 'target'=>"_blank"]); ?></p>

        <div class="form-group">
            <label for="json-input">Insira o código JSON</label>
            <textarea id="json-input" class="form-control" rows="10" placeholder='{"database": {"tables": ["tb_autores", "tb_categorias", "tb_editoras", "tb_emprestimos", "tb_livros", "tb_migration", "tb_usuario"]}}'></textarea>
        </div>
        
        <div class="form-group">
            <label for="module-name-input">Insira o nome do módulo</label>
            <?= Html::textInput('moduleName', '', ['id' => 'module-name-input', 'class' => 'form-control', 'maxlength' => true, 'placeholder' => 'Enter module name']) ?>
        </div>
        <button id="process-json-button" class="btn btn-primary">Processar JSON</button>
        
        <div id="table-list" class="mt-3">
            <!-- A lista de tabelas será exibida aqui -->
        </div>
        
        <div id="module-result" class="mt-3">
            <!-- O resultado será exibido aqui -->
        </div>
        <button id="copy-all-button" class="btn btn-primary mt-3" style="display:none;">Copiar Tudo</button>
    </div>
</div>

<div id="custom-alert" class="alert alert-primary custom-alert" role="alert">
</div>

<!-- Exemplo JSON Modal -->
<div class="modal fade" id="exemplojson" tabindex="-1" role="dialog" aria-labelledby="exemplojsonLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exemplojsonLabel">Exemplo JSON</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Exemplo JSON para emular as tabelas de banco de dados.</p>
                <pre>
{
  "database": {
    "tables": [
      "tb_autores",
      "tb_categorias",
      "tb_editoras",
      "tb_emprestimos",
      "tb_livros",
      "tb_migration",
      "tb_usuario"
    ]
  }
}
                </pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!--  Listar todas as tabelas de um banco de dados em MySQL e Oracle, -->
<div class="modal fade" id="listaTable" tabindex="-1" role="dialog" aria-labelledby="listaTableLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="listaTableLabel">Banco de dados em MySQL e Oracle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include 'modal/lista-table.php'; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!--  Listar todas as tabelas de um banco de dados em MySQL e Oracle, -->
  
<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$('#process-json-button').on('click', function() {
    processJSON();
});

function processJSON() {
    var jsonInput = $('#json-input').val();
    try {
        var jsonData = JSON.parse(jsonInput);
        var tables = jsonData.database.tables;
        var tableListHtml = '<h2>Tabelas de banco de dados</h2><ul class="list-group">';
        tables.forEach(function(table) {
            tableListHtml += '<li class="list-group-item">';
            tableListHtml += '<input type="radio" name="selectedTable" value="' + table + '" class="table-radio">';
            tableListHtml += '<label>' + table + '</label>';
            tableListHtml += '</li>';
        });
        tableListHtml += '</ul>';
        $('#table-list').html(tableListHtml);
        
        // Adiciona evento de mudança nos novos rádios
        $('.table-radio').on('change', function() {
            updateResult();
        });
    } catch (e) {
        showAlert('JSON inválido. Por favor, corrija e tente novamente.');
    }
}

function updateResult() {
    var moduleName = $('#module-name-input').val();
    if (!moduleName) {
        showAlert('Por favor, insira o nome do módulo.');
        return;
    }
    var capitalizedModuleName = moduleName.charAt(0).toUpperCase() + moduleName.slice(1);
    var selectedTable = $('input[name="selectedTable"]:checked').val();

    if (!selectedTable) {
        return;
    }

    var parts = selectedTable.split('_');
    var rightPart = parts.length > 1 ? parts[1].toUpperCase() : selectedTable.toUpperCase();

    var modelClass = 'app\\modules\\' + moduleName + '\\models\\' + rightPart;
    var namespace = 'app\\modules\\' + moduleName + '\\models';
    var searchModelClass = 'app\\modules\\' + moduleName + '\\models\\' + capitalizeFirstLetter(rightPart.toLowerCase()) + 'Search';
    var controllerClass = 'app\\modules\\' + moduleName + '\\controllers\\' + capitalizeFirstLetter(rightPart.toLowerCase()) + 'Controller';
    var viewPath = '@app/modules/' + moduleName + '/views/' + rightPart.toLowerCase();

    var resultHtml = 
        '<h1 class="modal-title"><span class="badge bg-dark">Module Generator</span></h1>' +
        createInputWithCopy('Module Class:', 'app\\modules\\' + moduleName + '\\' + capitalizedModuleName) +
        createInputWithCopy('Module ID:', moduleName) +
        '<h1 class="modal-title"><span class="badge bg-primary">Table Name</span></h1>' +
        createInputWithCopy('Selected Table:', selectedTable) +
        '<h1 class="modal-title"><span class="badge bg-warning text-dark">Model Generator</span></h1>' +
        createInputWithCopyAndToggle('Model Class Name:', rightPart) +
        createInputWithCopy('Namespace:', namespace) +
        '<h1 class="modal-title"><span class="badge bg-success">CRUD Generator</span></h1>' +
        createInputWithCopyAndToggle('Model Class:', modelClass) +
        createInputWithCopy('Search Model Class:', searchModelClass) +
        createInputWithCopy('Controller Class:', controllerClass) +
        createInputWithCopy('View Path:', viewPath);

    if (selectedTable) {
        $('#module-result').html(resultHtml);
        $('#copy-all-button').show().off('click').on('click', function() {
            copyAll();
        });
    } else {
        $('#module-result').html('');
        $('#copy-all-button').hide();
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function createInputWithCopy(label, value) {
    var inputId = label.replace(/\s+/g, '-').toLowerCase() + '-' + Math.random().toString(36).substr(2, 5);
    return '<div class="form-group">' +
               '<label>' + label + '</label>' +
               '<div class="input-group">' +
                   '<input type="text" class="form-control" id="' + inputId + '" value="' + value + '" readonly>' +
                   '<div class="input-group-append">' +
                       '<button class="btn btn-outline-secondary copy-button" type="button" data-target="' + inputId + '">Copiar</button>' +
                   '</div>' +
               '</div>' +
           '</div>';
}

function createInputWithCopyAndToggle(label, value) {
    var inputId = label.replace(/\s+/g, '-').toLowerCase() + '-' + Math.random().toString(36).substr(2, 5);
    return '<div class="form-group">' +
               '<label>' + label + '</label>' +
               '<div class="input-group">' +
                   '<input type="text" class="form-control toggle-target" id="' + inputId + '" value="' + value + '" readonly>' +
                   '<div class="input-group-append">' +
                       '<button class="btn btn-outline-secondary copy-button" type="button" data-target="' + inputId + '">Copiar</button>' +
                       (label === 'Model Class Name:' ? '<button class="btn btn-outline-secondary toggle-case-button" type="button" data-target="' + inputId + '">Alternar (Aa-aA)</button>' : '') +
                   '</div>' +
               '</div>' +
           '</div>';
}

$(document).on('click', '.copy-button', function() {
    var targetInputId = $(this).data('target');
    var targetInput = document.getElementById(targetInputId);
    targetInput.select();
    document.execCommand('copy');
    
    showAlert('Copiado: ' + targetInput.value);
});

$(document).on('click', '.toggle-case-button', function() {
    var targetInputId = $(this).data('target');
    var targetInput = document.getElementById(targetInputId);
    var currentValue = targetInput.value;

    var newValue;
    if (currentValue === currentValue.toUpperCase()) {
        newValue = capitalizeFirstLetter(currentValue.toLowerCase());
    } else {
        newValue = currentValue.toUpperCase();
    }

    targetInput.value = newValue;

    // Atualizar o valor correspondente no campo Model Class
    var modelClassInput = $('.toggle-target').filter(function() {
        return $(this).val().includes(currentValue);
    });

    if (modelClassInput.length > 0) {
        var newModelClassValue = modelClassInput.val().replace(currentValue, newValue);
        modelClassInput.val(newModelClassValue);
    }
});

function copyAll() {
    var allText = '';
    $('#module-result .form-group').each(function() {
        var label = $(this).find('label').text();
        var value = $(this).find('input[type="text"]').val();
        allText += label + '\n' + value + '\n';
    });
    
    var tempInput = $('<textarea>');
    $('body').append(tempInput);
    tempInput.val(allText).select();
    document.execCommand('copy');
    tempInput.remove();
    
    showAlert('Todos os valores foram copiados.');
}

function showAlert(message) {
    var alertBox = $('#custom-alert');
    alertBox.text(message).fadeIn();

    setTimeout(function() {
        alertBox.fadeOut();
    }, 2000);
}
</script>
</body>
