<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller {

	public function __invoke(Request $request, Response $response, $args) {
		$document = $this->container->get('document');
		$menu = $this->container->get('menu');
		$document->setAsset(["href" => "/js/app.js", "attributes" => ["async" => true]], "script");
		$document->setAsset(["href" => "/css/home.css"], "style");
		$document->setAsset("Filesharing Service", "title");
		$document->setAsset(["name" => "description", "content" => "Hello, Welcome to our filesharing service!"], "meta");

		$document->setVariable(["action" => "/upload", "method" => "POST"], "form");
		$document->setVariable($menu->getMenu(), "menu");

		$document->setTemplate("home.twig");
		$document->render($response);
	}
}