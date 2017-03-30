<?php
$container = $app->getContainer();
//logging
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};
// Twig
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../view', [
        //'cache' => '../cache'
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};
//Controllers

//controller File
$container['App\Controller\File'] = function ($c) use ($app) {
    return new App\Controller\File($c, $app);
};

//controller Home
$container['App\Controller\Home'] = function ($c) use ($app) {
    return new App\Controller\Home($c, $app);
};