
<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Conexões de Banco de Dados';
?>
<style>
    .btn-selected {
    background-color: #4CAF50; /* Cor verde personalizada */
    color: white;
}

.row-selected {
    background-color: #ecfd51; /* Cor de fundo personalizada para a linha */
    /* color: #c0c0c0; */
    font-weight: bold; /* fonte em negrito */
}
 
</style>

<div class="db-connection-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a('Criar Nova Conexão', ['create'], ['class' => 'btn btn-success']) ?></p>

    <p><strong>Legenda:</strong> A conexão selecionada está destacada em verde.</p>
    <!-- <p style="text-align: center;background-color: #400040; color: #FFFFFF; font-family: monospace; padding: 10px;">
        <b><?="Banco de dados selecionado: $selected"?></b>
    </p> -->
    
    <?php  include  Yii::getAlias('@app/views/giiwizard/modal/db-config.php'); ?>
    <?= GridView::widget([ 
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model, $key, $index, $grid) use ($selected) {
            return $model['name'] === $selected ? ['class' => 'row-selected'] : [];
        },
        'columns' => [
            'name',
            'username',
            'dsn',
            'charset',
            [
                'attribute' => 'tablePrefix',
                'label' => 'Prefixo da Tabela',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{select} {update} {delete}',
                'buttons' => [
                    'select' => function($url, $model, $key) use ($selected) {
                        $isSelected = $model['name'] === $selected;
                        $icon = $isSelected ? 'fas fa-check' : 'fas fa-hand-pointer';
                        $class = $isSelected ? 'btn btn-selected' : 'btn btn-warning';
                        return Html::a("<i class='{$icon}'></i>", ['select', 'name' => $model['name']], ['class' => $class, 'title' => $isSelected ? 'Selecionado' : 'Selecionar']);
                    },
                    'update' => function($url, $model, $key) {
                        return Html::a('<i class="fas fa-edit"></i>', ['update', 'name' => $model['name']], ['class' => 'btn btn-primary', 'title' => 'Atualizar']);
                    },
                    'delete' => function($url, $model, $key) {
                        return Html::a('<i class="fas fa-trash"></i>', ['delete', 'name' => $model['name']], [
                            'class' => 'btn btn-danger',
                            'title' => 'Deletar',
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
