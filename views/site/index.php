 <!-- Bootstrap CSS -->
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = 'Gii Wizard!';
?>
<?php
print_r($ebookItems);
//echo 
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Gii Wizard!</h1>
        <!-- <p class="lead">You have successfully created your Yii-powered application.</p> -->
        <p><a class="btn btn-lg btn-success" target="_blank" href="https://www.yiiframework.com">Comece com o Yii</a></p>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4 mb-5">
                <h2>Sistema com Módulos</h2>
                <p><?php echo Html::a('Gii Wizard para Sistema com Módulos', ['/site/commodule'], ['class' => 'btn btn-outline-warning']);?></p>                
                <p><?php echo Html::a('Gii Wizard para Sistema com Módulos (JSON)', ['/site/commodulejson'], ['class' => 'btn btn-outline-warning']);?></p>                
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#withModulesModal">
                <i class="fas fa-info-circle"></i> Sistema Com Módulos
                </button>               
            </div>
            
            <div class="col-lg-4 mb-5">
                <h2>Sistema sem Módulos</h2>
                <p><?php echo Html::a('Gii Wizard para Sistema sem Módulos', ['/site/semmodule'], ['class' => 'btn btn-outline-success']);?></p>
                <p><?php echo Html::a('Gii Wizard para Sistema sem Módulos (JSON)', ['/site/semmodulejson'], ['class' => 'btn btn-outline-success']);?></p>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#noModulesModal">
                <i class="fas fa-info-circle"></i> Sistema Sem Módulos
                </button>
            </div>
            <div class="col-lg-4 mb-5">
                <h2>Sobre o Giiwizard</h2>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#giiwizard">
                <i class="fas fa-info-circle"></i> Sistema Giiwizard
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- Modal Sistema Sem Módulos -->
<?php include 'modal/sem-modulos.php'; ?>
<!---->
<!-- Modal Sistema Com Módulos -->
<?php include 'modal/com-modulos.php'; ?>
<?php include 'modal/gii-wizard.php'; ?>
<!---->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>