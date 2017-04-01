<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller {

	public function __invoke(Request $request, Response $response, $args) {
		$document = $this->container->get('document');
		$document->setAsset(["href" => "/js/app.js", "attributes" => ["async" => true]], "script");
		$document->setAsset(["href" => "/css/home.css"], "style");
		$document->setAsset("Filesharing Service", "title");
		$document->setAsset(["name" => "description", "content" => "Hello, Welcome to our filesharing service!"], "meta");
		$document->setTemplate("home.twig");
		$document->render($response, ["form" => ["action" => "/upload", "method" => "POST"]]);

	}
}