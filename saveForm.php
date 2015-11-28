<?php

kirbytext::$tags['saveForm'] = array(
	'attr' => array(
		'fields'
	),
	'html' => function($tag) {
		if ($_POST["submitted"] == 'true') {
			require_once('procesForm.php');
		} else {
			require_once('createForm.php');
		}
	}
);