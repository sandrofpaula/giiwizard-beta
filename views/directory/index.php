<?php
use yii\helpers\Html;
use yii\grid\GridView;
$directory=$_GET["directory"] ;
$this->title = 'Gerenciar diretórios de arquivos JSON';
?>
<div class="directory-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('Explorar Diretório Novo', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'path',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view-files} {update} {delete}',
                'buttons' => [
                    'view-files' => function ($url, $model) {
                        return Html::a('<i class="fas fa-folder-open"></i>', ['json-file/index-by-directory', 'directory' => $model['path']], [
                            'class' => 'btn btn-info',
                            'title' => 'Ver Arquivos JSON'
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model['id']], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Você tem certeza que deseja deletar este item?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php include 'modal/view_diretorios.php'; ?>
</div>

