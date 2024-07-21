<?php
// Função para detectar o IP da máquina
/* function getHostIp()
{
    $hostIp = '127.0.0.1'; // Valor padrão caso não consiga detectar o IP
    $ifconfig = shell_exec('ifconfig') ?: shell_exec('ip addr show');

    if ($ifconfig) {
        preg_match('/inet (\d+\.\d+\.\d+\.\d+)/', $ifconfig, $matches);
        if (isset($matches[1])) {
            $hostIp = $matches[1];
        }
    }

    return $hostIp;
} */

// Função para obter o baseUrl dinamicamente
/* function getBaseUrl()
{
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    if (strpos($host, 'giiwizard') !== false) {
        return 'http://giiwizard:8081';
    } else {
        return 'http://' . getHostIp() . ':8081';
    }
} */



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
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
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
            // send all mails to a file by default.
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
        
       /*  'urlManager' => [
            'class' => 'yii\web\UrlManager',
            //'baseUrl' => 'http://giiwizard:8081'
            //'baseUrl' => 'http://192.168.0.4:8081',
            //Você usa uma configuração condicional baseada no ambiente (YII_ENV_DEV). 
            //Isso permite que você use diferentes valores para baseUrl dependendo de 
            //se você está em um ambiente de desenvolvimento ou produção.
            'baseUrl' => (YII_ENV_DEV) ? 'http://192.168.0.4:8081' : 'http://giiwizard:8081',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ], */
        /* 'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => getBaseUrl(),
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Suas regras de URL aqui
            ],
        ], */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
       
    ],
    'params' => $params,
    //'defaultRoute'=>'site/login',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
