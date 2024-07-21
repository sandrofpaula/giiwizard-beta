<?php

//$configFile = __DIR__ . '/db-connections.json';
//$configFile = Yii::getAlias('@app/web/data/db-connections.json');//não funciona
$configFile = __DIR__ . '/../web/data/db-connections.json';
$configData = json_decode(file_get_contents($configFile), true);

$selectedConnection = null;

foreach ($configData['connections'] as $connection) {
    if ($connection['name'] === $configData['selected']) {
        $selectedConnection = $connection;
        break;
    }
}

if ($selectedConnection === null) {
    throw new \Exception('Nenhuma conexão de banco de dados selecionada.');
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => $selectedConnection['dsn'],
    'username' => $selectedConnection['username'],
    'password' => $selectedConnection['password'],
    'charset' => $selectedConnection['charset'],
    'tablePrefix' => isset($selectedConnection['tablePrefix']) ? $selectedConnection['tablePrefix'] : '',
];
 


