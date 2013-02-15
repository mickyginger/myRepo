<?php

class formInput{
	var $type;
	var $required;
	var $label;
	var $id;
	var $name;
	var $value;
	var $error;

	function __construct($type, $is_required, $label, $name, $id = NULL, $value = NULL){
		$this->type = $type;
		$this->required = $is_required;
		$this->label = $label;
		$this->name = $name;
		$this->id = $id ? $id : $name;
		$this->value = $value;
	}

	function __toString(){
		if(!empty($_REQUEST)) $this->validate();
		if($this->type != 'textarea'){
			$html = '<label for="' . $this->id . '">' . $this->label;
			if($this->required) $html .= '<span class="required">*</required>';
			$html .= '</label><input type="' . $this->type . '" name="' . $this->name . '" id="' . $this->id . '" value="' . $this->value . '">';
		} else {
			$html = '<label for="' . $this->id . '">' . $this->label . '</label><textarea name="' . $this->name . '" id="' . $this->id . '">' . $this->value . '</textarea>';
		}

		if(!empty($this->error)) $html .= '<span class="error">' . $this->error . '</span>';

		return $html;
	}

	function validate(){

		if(isset($_REQUEST[$this->name]) && $this->required){
			switch($this->type){
				case 'text':
				case 'textarea':
					if(empty($_REQUEST[$this->name])) $this->error = 'Please fill out this field';
					else $this->value = $_REQUEST[$this->name];
					break;
				case 'email':
					if(!filter_var($_REQUEST[$this->name], FILTER_VALIDATE_EMAIL)) $this->error = 'Please enter a valid emial address';
					else $this->value = $_REQUEST[$this->name];
					break;
				case 'tel':
					$value = str_replace(array("+", " ", "(", ")"), array("00", ""), $_REQUEST[$this->name]);
					if(!is_numeric($value)) $this->error = 'Please enter a valid number';
					else $this->value = $_REQUEST[$this->name];
					break;
				case 'number':
					if(!is_numeric($_REQUEST[$this->name])) $this->error = 'Please enter a numeric value';
					else $this->value = $_REQUEST[$this->name];
					break;
			}
		}
	}
}


class formClass{
	var $method;
	var $inputs;
	var $errors;

	function __construct($method, $args){
		$this->method = $method;
		foreach($args as $arg){
			$this->inputs[] = isset($arg[3]) ? new formInput($arg[0], $arg[1], $arg[2], $arg[3]) : new formInput($arg[0], $arg[1], $arg[2]);
		}
	}

	function __toString(){
		$required_fields = false;
		$form = '<form method="' . $this->method . '" novalidate="novakidate">';
		foreach($this->inputs as $input){
			$form .= '<div>' . $input . '</div>';
			if($input->required) $required_fields = true;
		}
		$form .= '<div><input type="submit"></div>';
		if($required_fields) $form .= '<p><small>* indicated a required field</small></p>';
		$form .= '</form>';
		return $form;
	}
}