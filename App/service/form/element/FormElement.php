<?php
namespace App\Service\Form\Element;

Abstract class FormElement {
	protected $attributes = [];
	protected $label;
	protected $tag;
	public function __construct($attributes) {
		$this->attributes = $attributes;
	}
	public function __toString() {
		return $this->render();
	}
	abstract public function render();
	abstract protected function wrapElement(string $element);
	abstract protected function getElement();
	public function setLabel(string $label) {
		$this->label = $label;
	}
}