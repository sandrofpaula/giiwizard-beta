<?php

$configFile = Yii::getAlias('@app/web/data/db-connections.json');
$configData = json_decode(file_get_contents($configFile), true);

$selectedConnection = null;

foreach ($configData['connections'] as $connection) {
    if ($connection['name'] === $configData['selected']) {
        $selectedConnection = $connection;
        break;
    }
}
?>
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

<div class="text-right">
    <button type="button" class="btn btn-warning"  id="openModalBtn">
        <i class="fas fa-info-circle"></i> db config
    </button>    
</div>

<div class="modal" id="dbconfig">
    <div class="modal-dialog modal-dialog-custom">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configuração de db selecionada</h5>
                <button type="button" class="close" id="closeModalBtn">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Configuração de db.php</p>
                <div style="background-color: #400040; color: #FFFFFF; font-family: monospace; padding: 10px;">
                    <?php
                    echo "'class' => 'yii\\db\\Connection',<br>" .
                         "'dsn' => '" . $selectedConnection['dsn'] . "',<br>" .
                         "'username' => '" . $selectedConnection['username'] . "',<br>" .
                         "'password' => '" . $selectedConnection['password'] . "',<br>" .
                         "'charset' => '" . $selectedConnection['charset'] . "',<br>" .
                         "'tablePrefix' => '" . (isset($selectedConnection['tablePrefix']) ? $selectedConnection['tablePrefix'] : '') . "',";
                    ?>
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
