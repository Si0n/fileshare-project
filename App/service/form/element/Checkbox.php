<?php
/**
 * Created by PhpStorm.
 * User: sion
 * Date: 02.04.2017
 * Time: 12:48
 */

namespace App\Service\Form\Element;


class Checkbox extends Input {
	protected $elements = [];
	public function __construct($elements) {
		foreach ($elements as $element) {
			$element['type'] = 'checkbox';
			$this->elements[] = new TextInput($element);
		}
	}
	public function render() {
		return $this->wrapElement($this->getElement());
	}
	protected function wrapElement(string $element): string {
		$html = "<div class=\"form-group\">";
		if (!empty($this->label)) {
				$html .= "<h3>{$this->label}</h3>{$element}";
		} else {
			$html .= $element;
		}
		$html .= "</div>";
		return $html;
	}

	protected function getElement(): string {
		$html = '';
		$html .= implode(" ", $this->elements);
		return $html;
	}
}