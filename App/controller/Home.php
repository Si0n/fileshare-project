<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller {

	public function __invoke(Request $request, Response $response, $args) {
		$document = $this->container->get('document');
		$session = $this->container->get('session');
		$document->setVariable(["action" => "/upload", "method" => "POST"], "form");
		//uploaded at this session
		$files = $session->get('files');
		if (!empty($files)) {
			$document->setVariable($files, "files");
		}

		$document->setTemplate("home.twig");
		$document->render($response);
	}
}