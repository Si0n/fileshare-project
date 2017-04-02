<?php
/**
 * Created by PhpStorm.
 * User: sion
 * Date: 02.04.2017
 * Time: 12:48
 */

namespace App\Service\Form\Element;


class Textarea extends FormElement {
	protected $tag = 'textarea';
	public function __construct($attributes) {
		if (isset($attributes['label'])) {
			$this->setLabel($attributes['label']);
			unset($attributes['label']);
		}
		$this->attributes = $attributes;
	}

	public function render():string {
		return $this->wrapElement($this->getElement());
	}

	protected function wrapElement(string $element): string {
		$html = "";
		if (!empty($this->label)) {
			if (!empty($this->attributes['id'])) {
				$html .= "<label for=\"{$this->attributes['id']}\">{$this->label}</label>{$element}";
			} else {
				$html .= "<label>{$this->label}{$element}</label>";
			}
		} else {
			$html = $element;
		}
		return $html;
	}

	protected function getElement(): string {
		$html = "<{$this->tag}";
		foreach ($this->attributes as $attribute => $value) {
			if ($attribute == 'value') continue;
			$html .= " {$attribute}=\"{$value}\"";
		}
		$html .= ">" . ($this->attributes['value'] ?? "")  .  "</{$this->tag}>";
		return $html;
	}
}