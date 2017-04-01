<?php

namespace App\Controller;

use App\Service\Document;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class Controller {
	protected $container;
	protected $table;
	protected $html;

	public function __construct(Container $container) {
		$this->container = $container;
	}

	abstract public function __invoke(Request $request, Response $response, $args);
}