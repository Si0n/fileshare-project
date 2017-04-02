<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller {

	public function __invoke(Request $request, Response $response, $args) {
		$document = $this->container->get('document');
		$form = $this->container->get('form');
		/*FORM*/
		$form->addElement('input',
			["type" => 'text',
			"value" => "test test test",
			"data-value" => "data-value-test",
			"id" => "xx2",
			"label" => "XXXWEDWFSS",
			"class" => "form-control"]);
		$form->addElement('textarea',
			["value" => "text dfasjfasdk fdakf jdasfldkajfdslka jfdaif jdal;fja l;sdfa",
			"data-value" => "data-dsad-test",
			"id" => "231fdsaq",
			"label" => "fafdafdafdafadfads",
			"class" => "form-control"]);
		$form->addElement('radio',
			[["value" => "text dfasjfasdk fdakf jdasfldkajfdslka jfdaif jdal;fja l;sdfa",
			"name" => "test-checkbox",
			"label" => "1",
			"class" => "form-control"],
			["value" => "text dfasjfasdk fdakf jdasfldkajfdslka jfdaif jdal;fja l;sdfa",
				"data-value" => "data-dsad-test",
				"name" => "test-checkbox",
				"label" => "2",
				"class" => "form-control"],
			["value" => "text dfasjfasdk fdakf jdasfldkajfdslka jfdaif jdal;fja l;sdfa",
				"data-value" => "data-dsad-test",
				"name" => "test-checkbox",
				"label" => "3",
				"class" => "form-control"]]);
		$test = $form->render();
		/*FORM*/

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