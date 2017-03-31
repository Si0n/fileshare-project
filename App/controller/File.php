<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class File extends Controller {
	public function __invoke(Request $request, Response $response, $args) {
		$x = 0;
	}
	public function upload(Request $request, Response $response, $args) {
		$upload = $this->container->get('upload');
		$files = $upload->files($request);
		$x = 0;

	}

}