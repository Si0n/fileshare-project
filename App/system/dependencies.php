<?php
$container = $app->getContainer();
//logging
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

//Services
$container['password'] = function ($c)  {
   return new App\Service\Password();
};

$container['upload'] = function ($c)  {
   return new App\Service\Upload($c);
};
$container['menu'] = function ($c)  {
   return new App\Service\Menu($c);
};
// Document
$container['document'] = function ($container) {
	$twig = new \Slim\Views\Twig('../App/view', [
		//'cache' => '../cache'
		'cache' => false
	]);
	// Instantiate and add Slim specific extension
	$basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
	$twig->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
	$twig->offsetSet('globals', $container->get('twig_globals'));
	return  new \App\Service\Document($twig);
};

$container['directory'] = function ($c)  {
	return new App\Service\Directory($c->get('settings')['file_directory']);
};

//Email
$container['mail'] = function ($c)  {
	return new SimpleMail();
};
