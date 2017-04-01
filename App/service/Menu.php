<?php

namespace App\Service;

use Slim\Container;

class Menu {
	private $container;
	public function __construct(Container $container) {
		$this->container = $container;
	}
	public function getMenu() {
		return [
			"home" => ["name" => "Home", "href" => "/", "icon" => "fa-home"],
			"signin" => ["name" => "Sign in / Sign up", "href" => "/sign", "icon" => "fa-sign-in"],
		];
	}
}