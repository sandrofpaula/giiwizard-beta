<?php

return [
    'class' => 'yii\db\Connection',
    // 'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    // Usar 'host.docker.internal' para se conectar ao MySQL no host quando usando Docker Desktop
    // Para um banco de dados em outro servidor, use o endereço IP ou nome de domínio do servidor 
    // (ex: 'mysql:host=192.168.1.100;dbname=yii2basic')
    'dsn' => 'mysql:host=host.docker.internal;dbname=yii2basic',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'tablePrefix' => 'tb_',

    // Opções de cache de esquema (para ambiente de produção)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
