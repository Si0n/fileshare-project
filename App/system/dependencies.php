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
    $view = new \Slim\Views\Twig('../App/view', [
        //'cache' => '../cache'
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};
//Services
$container['password'] = function ($c)  {
   return new App\Service\Password();
};

$container['upload'] = function ($c)  {
   return new App\Service\Upload($c);
};

$container['directory'] = function ($c)  {
	return new App\Service\Directory($c->get('settings')['file_directory']);
};

//Email
$container['mail'] = function ($c)  {
	return new SimpleMail();
};
