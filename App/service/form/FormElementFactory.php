<?php
namespace App\Service\Form;
use App\Service\Form\Element\Checkbox;
use App\Service\Form\Element\Radio;
use App\Service\Form\Element\Select;
use App\Service\Form\Element\Textarea;
use App\Service\Form\Element\TextInput;

/**
 * Created by PhpStorm.
 * User: sion
 * Date: 02.04.2017
 * Time: 12:23
 */
abstract class FormElementFactory {

	static public function create($type, Array $attributes) {
		switch ($type) {
			case 'checkbox' :
				return new Checkbox($attributes);
			case 'radio' :
				return new Radio($attributes);
			case 'select':
				return new Select($attributes);
			case 'textarea' :
				return new Textarea($attributes);
			case 'input' :
				return new TextInput($attributes);
			default :
				return false;
		}
	}

}