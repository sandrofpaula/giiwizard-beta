<?php
$configFile = __DIR__ . '/db-config.json';
$configData = json_decode(file_get_contents($configFile), true);

return [
    'class' => 'yii\db\Connection',
    // 'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    // Usar 'host.docker.internal' para se conectar ao MySQL no host quando usando Docker Desktop
    // Para um banco de dados em outro servidor, use o endereço IP ou nome de domínio do servidor 
    // (ex: 'mysql:host=192.168.1.100;dbname=yii2basic')
    // Carregar o nome do banco de dados a partir do arquivo JSON
    'dsn' => 'mysql:host=host.docker.internal;dbname=' . $configData['dbname'],
    'username' => $configData['username'],
    'password' => $configData['password'],
    //'username' => 'root',
    //'password' => '',
    'charset' => 'utf8',
    'tablePrefix' => 'tb_',

    // Opções de cache de esquema (para ambiente de produção)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
