<?php

namespace App\Controller;

use Slim\App;
use Slim\Container;

abstract class Controller {
	var $container;
	var $app;
	protected $table;
	protected $html;

	public function __construct(Container $container, App $app) {
		$this->container = $container;
		$this->app = $app;
	}

	public function __get($var) {
		return $this->container->{$var};
	}
	public function setModel($model) {
		$this->model = $model;
		return $this;
	}
	abstract public function index($request, $response, $args);
}