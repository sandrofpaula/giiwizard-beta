<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .profile-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        max-width: 300px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        margin: 20px auto;
    }
    .profile-card img {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
    }
    .profile-card h2 {
        font-size: 24px;
        margin: 10px 0;
    }
    .profile-card h3 {
        font-size: 18px;
        margin: 10px 0;
    }
    .profile-card a {
        color: #0073b1;
        text-decoration: none;
        font-size: 16px;
    }
    .profile-card a:hover {
        text-decoration: underline;
    }
</style>

<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Sobre';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code> -->
</div>
<div class="col-lg-4 mb-5">
    <div class="profile-card">
        <a href="https://www.linkedin.com/in/sandro-paula-379091108/" target="_blank">
            <img src="https://media.licdn.com/dms/image/D4D03AQEwm5jY7X2IBQ/profile-displayphoto-shrink_200_200/0/1689533276105?e=1726099200&v=beta&t=nggA7hapaKESSongOubl57dF8jpOSfUUJtMGKgMw1eM" alt="Sandro Fonseca Paula">
        </a>
        <p>Criador</p>
        <h2>Sandro Fonseca Paula</h2>
        <h3>Analista Programador WEB</h3>
        <a href="https://www.linkedin.com/in/sandro-paula-379091108/" target="_blank"><h1><i class="fa-brands fa-linkedin fa-beat"></i></h1></a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>