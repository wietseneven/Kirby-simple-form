<?php

kirbytext::$tags['saveForm'] = array(
	'attr' => array(
		'fields'
	),
	'html' => function($tag) {
		// If form was submitted go proces to form, else render the form
		if ($_POST["submitted"] == 'true') {
			require_once('procesForm.php');
		} else {
			require_once('createForm.php');
		}
	}
);