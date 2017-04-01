<?php

namespace App\Controller;

use App\Service\Password;
use Slim\Http\Request;
use Slim\Http\Response;

class User extends Controller {
	private $form = [
		"sign_up" => ["action" => '/sign', "method" => "post"],
		"sign_in" => ["action" => '/sign', "method" => "post"]
	];
	private $form_data = [
		"sign_up" => [],
		"sign_in" => [],
	];
	private $form_errors = [
		"sign_up" => [],
		"sign_in" => [],
	];
	public function __invoke(Request $request, Response $response, $args) {
		$document = $this->container->get('document');
		$menu = $this->container->get('menu');
		$document->setAsset(["href" => "/js/app.js", "attributes" => ["async" => true]], "script");
		$document->setAsset(["href" => "/css/home.css"], "style");
		$document->setAsset("Filesharing Service", "title");
		$document->setAsset(["name" => "description", "content" => "Hello, Welcome to our filesharing service!"], "meta");
		$document->setTemplate("home.twig");
		$document->setVariable(["action" => "/upload", "method" => "POST"], "form");
		$document->setVariable($menu->getMenu(), "menu");
		$document->render($response);

	}

	public function sign(Request $request, Response $response, $args) {
		$document = $this->container->get('document');
		$menu = $this->container->get('menu');
		$post = $request->getParsedBody();
		if (!empty($post['type'])) {

			switch ($post['type']) {
				case 'sign-in' :
					break;
				case 'sign-up' :
					$user = new \App\Model\User();
					$this->form_data['sign_up']['email'] = $post['email'];
					$this->form_data['sign_up']['name'] = $post['name'];

					if ($user->validateUserName($post['name'])) {
						$user->first_name = $post['name'];
					} else {
						$this->form_errors['sign_up']['name']['state'] = 'error';
					}
					if ($user->validateUserEmail($post['email'])) {
						$user->email = $post['email'];
					} else {
						$this->form_errors['sign_up']['email']['state'] = 'error';
					}

					if ($user->validateUserPassword($post['password'])) {
						$user->password = Password::encryptPassword($post['password']);
					} else {
						$this->form_errors['sign_up']['password']['state'] = 'error';
					}
					if (empty(array_filter($this->form_errors, function($el) { return !empty($el); }))) {
						$user->save();
					}
					break;
				default :
					break;
			}
			if (!empty($this->form_errors)) {
				$document->setVariable($this->form_errors, "form_errors");
			}
		}
		$document->setVariable($this->form, "form");
		$document->setVariable($this->form_data, "form_data");
		$document->setAsset(["href" => "/js/app.js", "attributes" => ["async" => true]], "script");
		$document->setAsset(["href" => "/css/home.css"], "style");
		$document->setAsset("Sign up / Sign in", "title");
		$document->setAsset(["name" => "description", "content" => "Sign up / Sign in page"], "meta");
		$document->setTemplate("sign.twig");

		$document->setVariable($menu->getMenu(), "menu");
		$document->render($response);
	}

}