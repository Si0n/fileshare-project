<?php

namespace App\Service;

use App\Service\Form\FormElementFactory;
use Slim\Container;

class Form {
	private $container;
	private $form_elements = []; //array of FormElement objects
	public function __construct(Container $container) {
		$this->container = $container;
	}

	public function addElement($type, array $parameters, string $label = '') {
		$input = FormElementFactory::create($type, $parameters);
		if (!empty($label)) {
			$input->setLabel($label);
		}
		$this->form_elements[] = $input;
	}
	public function render() {
		return implode(" ", $this->form_elements);
	}

}
