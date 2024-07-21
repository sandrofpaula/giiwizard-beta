<?php

function getBaseUrl()
{
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    if (strpos($host, 'giiwizard') !== false) {
        return 'http://giiwizard:8081';
    } else {
        return 'http://localhost:8081'; // Ajuste conforme necessário
    }
}

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'giiwizard',
    'name' => 'Gii Wizard',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'L8gkFg7nNh9QDmY9UL_q7ya2qhQo_pAb',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => getBaseUrl(),
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Suas regras de URL aqui
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // Adicionar o IP manualmente
    $detectedIp = '192.168.0.4'; // Substitua pelo IP da sua máquina

    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', $detectedIp],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', $detectedIp],
    ];
}

return $config;
