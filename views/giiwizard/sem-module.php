<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Sem Module';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<?php
 // Obter a conexão com o banco de dados
 $db = Yii::$app->db;
 // Obter os nomes das tabelas
 $tables = $db->schema->getTableNames();
?>
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
    <!--  Configuração selecionada do db.php -->
    <?php include 'modal/db-config.php'; ?>
    <!--  Configuração selecionada do db.php -->
    <div class="site-about">
        <h1 class="modal-title"><span class="badge bg-danger">Gii Wizard</span></h1>
        <h2>Tabelas de banco de dados</h2>
        <ul class="list-group">
            <?php foreach ($tables as $table): ?>
                <li class="list-group-item">
                    <?= Html::radio('selectedTable', false, ['value' => $table, 'class' => 'table-radio', 'name' => 'selectedTable']) ?>
                    <?= Html::encode($table) ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <div id="module-result" class="mt-3">
            <!-- O resultado será exibido aqui -->
        </div>
        <button id="copy-all-button" class="btn btn-primary mt-3" style="display:none;">Copiar Tudo</button>
    </div>
</div>

<div id="custom-alert" class="alert alert-primary custom-alert" role="alert">
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).on('change', '.table-radio', function() {
    updateResult();
});

function updateResult() {
    var moduleName = 'proesc'; // Nome do módulo fixo
    var capitalizedModuleName = moduleName.charAt(0).toUpperCase() + moduleName.slice(1);
    var selectedTable = $('input[name="selectedTable"]:checked').val();

    if (!selectedTable) return;

    var parts = selectedTable.split('_');
    var rightPart = parts.length > 1 ? parts[1].toUpperCase() : selectedTable.toUpperCase();

    var modelClass = 'app\\' + 'models\\' + rightPart;
    var namespace = 'app\\' + 'models';
    var searchModelClass = 'app\\' + 'models\\' + capitalizeFirstLetter(rightPart.toLowerCase()) + 'Search';
    var controllerClass = 'app\\' + 'controllers\\' + capitalizeFirstLetter(rightPart.toLowerCase()) + 'Controller';
    var viewPath = '@app/' + 'views/' + rightPart.toLowerCase();

    var resultHtml = 

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
    var allValues = [];
    $('#module-result .form-group').each(function() {
        var label = $(this).find('label').text();
        var value = $(this).find('input[type="text"]').val();
        allValues.push(label + ' ' + value);
    });
    var allText = allValues.join('\n');
    
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
