<?php
use yii\helpers\Html;

$this->title = 'Lista de Erros';
?>
<div class="error-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('Criar Novo Erro', ['create'], ['class' => 'btn btn-success']) ?></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Mensagem</th>
                <th>Categoria</th>
                <th>Banco de Dados</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($errors as $code => $error): ?>
            <tr>
                <td><?= Html::encode($code) ?></td>
                <td><?= Html::encode($error['name']) ?></td>
                <td><?= Html::encode($error['message']) ?></td>
                <td><?= Html::encode($error['categoria']) ?></td>
                <td><?= Html::encode($error['bancoDeDados']) ?></td>
                <td>
                    <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'code' => $code], ['class' => 'btn btn-primary','title' => 'Atualizar',]) ?>
                    <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'code' => $code], [
                        'class' => 'btn btn-danger',
                        'title' => 'Deletar',
                        'data' => [
                            'confirm' => 'Você tem certeza que deseja deletar este item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
