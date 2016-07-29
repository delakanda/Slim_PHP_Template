<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
	]
]);


//setup view in the container
$container = $app->getContainer();

$container['view'] = function($container) {

	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
		//'cache'	=>	__DIR__ . '/../storage/cache/views',
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	return $view;
};

$container['MainController'] = function($container) {
	return new \App\Controllers\MainController($container);
};

require __DIR__ . '/../app/routes.php';