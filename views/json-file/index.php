<?php
use yii\helpers\Html;
use yii\grid\GridView;

//$this->title = 'Gerenciar Arquivos JSON';
$this->params['breadcrumbs'][] = ['label' => 'Gerenciar Diretórios', 'url' => ['directory/index']];
$this->title = "Gerenciar Arquivos ". $_GET["directory"];
//$this->params['breadcrumbs'][] = 'Comandos';
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = $categoria;
?>
<!-- directory/index -->
<div class="json-file-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('Criar Novo Arquivo JSON', ['create', 'directory' => $_GET["directory"]], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            //'directory',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',//
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', ['view', 'directory' => $model['directory'], 'name' => $model['name']], [
                            'class' => 'btn btn-primary',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-edit"></i>', ['update', 'directory' => $model['directory'], 'name' => $model['name']], [
                            'class' => 'btn btn-warning',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', ['delete', 'directory' => $model['directory'], 'name' => $model['name']], [
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
</div>
<?php //include Yii::getAlias('@app/views/directory/modal/view_diretorios.php'); ?>
<!-- <div style="margin-left: 20%; margin-right: 20%;">
    <?php //echo file_get_contents(Yii::getAlias('@app/web/file/html/1.html')) ?>
</div> -->
