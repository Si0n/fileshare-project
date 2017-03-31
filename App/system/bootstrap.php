<?php
//Define model
$container = $app->getContainer();
$database_settings = $container->get('settings')['db'];
$database_settings['driver'] = 'mysql';
$container = $app->getContainer();
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($database_settings);
$capsule->bootEloquent();
//define router
require_once 'dependencies.php';
require_once 'router.php';