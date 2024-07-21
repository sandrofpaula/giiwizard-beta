<?php
/* @var $this yii\web\View */
/* @var $content string */
/* @var $path string */



$this->title = 'Visualizando Arquivo: ' . basename($path);



//$this->title = 'Gerenciar Arquivos JSON';
$this->params['breadcrumbs'][] = ['label' => 'Gerenciar Diretórios', 'url' => ['directory/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="file-view">
    <h1><?= $this->title ?></h1>
    <pre><?= htmlspecialchars($content) ?></pre>
</div>
