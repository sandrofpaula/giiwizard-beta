<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$themeMode = Yii::$app->request->cookies->getValue('theme_mode', '0'); // Pega a preferência do cookie

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    .container, .container-lg, .container-md, .container-sm, .container-xl {
        max-width: 1500px;
    }
</style>
</head>
<body class="d-flex flex-column h-100">

<?php $this->beginBody() ?>
<?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
<header id="header">
    <?php

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'SGdb', 'url' => [''],
                'items' => [
                    ['label' => 'Gerenciar SGdb', 'url' => ['/db-connection/index']],
                    ['label' => 'Com Module', 'url' => ['/site/commodule']],
                    ['label' => 'Sem Module', 'url' => ['/site/semmodule']],
                ]
            ],
            ['label' => 'JSON', 'url' => [''],
                'items' => [
                    ['label' => 'Com Module JSON', 'url' => ['/site/commodulejson']],
                    ['label' => 'Sem Module JSON', 'url' => ['/site/semmodulejson']],
                ]
            ],
            ['label' => 'Gerenciar Error', 'url' => ['/error/index']],
            ['label' => 'Gerenciar Arquivos JSON', 'url' => ['/directory/index']],
            ['label' => 'Extra', 'url' => [''],
                'items' => [
                    ['label' => 'Bootstrap Icons', 'url' => ['/site/icones-bootstrap']],
                    ['label' => 'Font Awesome Icons', 'url' => ['/site/icones-font-awesome']],
                    ['label' => 'Json Formatter', 'url' => ['/site/json-formatter']],
                ]
            ],
            ['label' => 'Sobre', 'url' => ['/site/about']],

        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 d-flex align-items-center justify-content-center justify-content-md-start">
                <a href="https://www.linkedin.com/in/sandro-paula-379091108/" target="_blank" class="me-2">
                    <h3><i class="fa-brands fa-linkedin fa-beat"></i></h3>
                </a>
                <span><?= date('Y') ?> | @sandrofpaula</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <?= Yii::powered() ?>
            </div>
        </div>
    </div>
</footer>






<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
