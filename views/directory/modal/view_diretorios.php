<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    .modal-dialog-custom {
        max-width: 90%; /* Ajuste esta largura conforme necessário */
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-dialog {
        position: relative;
        margin: 10% auto;
        width: 80%;
        /* max-width: 600px; */
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-header,
    .modal-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header .close {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .modal-footer {
        margin-top: 20px;
    }

    /* .btn {
        padding: 10px 20px;
        cursor: pointer;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: white;
    } */
</style>
<?php
$this->registerCss("
.tree {
    list-style-type: none;
    position: relative;
    padding-left: 20px;
}

.tree ul {
    list-style-type: none;
    padding-left: 20px;
}

.tree ul::before {
    content: '';
    border-left: 1px solid #000;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 10px;
}

.tree li {
    margin: 0;
    padding: 10px 5px 0 5px;
    position: relative;
}

.tree li::before, .tree li::after {
    content: '';
    position: absolute;
    left: -10px;
}

.tree li::before {
    border-top: 1px solid #000;
    top: 10px;
    width: 10px;
    height: 0;
}

.tree li::after {
    border-left: 1px solid #000;
    height: 100%;
    width: 0px;
    top: 0;
}

.tree li:last-child::after {
    height: 10px;
}

.tree li > span {
    display: flex;
    align-items: center;
}

.tree i {
    margin-right: 5px;
}

.folder-color {
    color: #000000;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Adiciona sombra ao texto */
}

.php-file-color {
    color: #4F5D95;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Adiciona sombra ao texto */
}

.json-file-color {
    color: #f1c40f;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Adiciona sombra ao texto */
}

.html-file-color {
    color: #e34c26;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Adiciona sombra ao texto */
}

.md-file-color {
    color: #6f42c1;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Adiciona sombra ao texto */
}

.default-file-color {
    color: #2d3436;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Adiciona sombra ao texto */
}


");


function renderTree($directoryStructure, $prefix = '')
{
    $html = '<ul class="tree">';
    foreach ($directoryStructure as $item) {
        $name = Html::encode($item['name']);
        $path = isset($item['path']) ? $item['path'] : null;
        if ($path) {
            // Gera a URL para a visualização no editor
            $url = Url::to(['json-file/view', 'directory' => dirname($path), 'name' => basename($path)]);
            $html .= "<li><span class=\"{$item['colorClass']}\"><i class=\"{$item['icon']}\"></i>" . Html::a($name, $url, ['target' => '_blank']) . "</span></li>";
        } else {
            $html .= "<li><span class=\"{$item['colorClass']}\"><i class=\"{$item['icon']}\"></i>$name</span>";
            if (isset($item['children'])) {
                $html .= renderTree($item['children'], $prefix . '    ');
            }
            $html .= "</li>";
        }
    }
    $html .= '</ul>';
    return $html;
}
?>

<div class="text-right">
    <button type="button" class="btn btn-warning"  id="openModalBtn">
        <i class="fas fa-info-circle"></i> Diretórios @app/web/data/
    </button>    
</div>

<div class="modal" id="dbconfig">
    <div class="modal-dialog modal-dialog-custom">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Diretórios @app/web/data/</h5>
                <button type="button" class="close" id="closeModalBtn">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Diretórios @app/web/data/</p>
                <div style="background-color: #ceccca;">
                    <h1><?= $this->title ?></h1>
                    <?= renderTree($directoryStructure) ?>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalFooterBtn">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('openModalBtn').addEventListener('click', function() {
        document.getElementById('dbconfig').style.display = 'block';
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('dbconfig').style.display = 'none';
    });

    document.getElementById('closeModalFooterBtn').addEventListener('click', function() {
        document.getElementById('dbconfig').style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('dbconfig')) {
            document.getElementById('dbconfig').style.display = 'none';
        }
    });
</script>
