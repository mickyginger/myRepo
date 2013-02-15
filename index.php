<?php
include('form_classes.php');


//create form
$inputs = array(
		array('text', 1, 'Name: ', 'name'),
		array('email', 1, 'Email: ', 'myemail', 'email'),
		array('tel', 0, 'Tel: ', 'tel', 'tel'),
		array('number', 0, 'Age: ', 'age', 'age'),
		array('textarea', 0, 'Description: ', 'description'),
	);

$form = new formClass('post', $inputs);

echo $form;

var_dump($form);
?>