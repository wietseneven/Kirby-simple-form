<?php

kirbytext::$tags['saveForm'] = array(
	'attr' => array(
		'fields',
		'confirmation'
	),
	'html' => function($tag) {
		// If form was submitted go proces to form, else render the form
		if ($_POST["submitted"] == 'true') {
			require_once(__DIR__ . DS . 'lib' . DS . 'procesForm.php');
			// Clear post data to prevent double submissions
			header('Location:'.$_SERVER['PHP_SELF'].'?formres=true');
		} else if ($_GET['formres'] == 'true') {
			if ($tag->attr('confirmation')) {
				$confirmationMessage = $tag->attr('confirmation');
			} else {
				$confirmationMessage = 'Form submitted succesfully';
			}
			return $confirmationMessage;
		} else {
			require_once(__DIR__ . DS . 'lib' . DS . 'createForm.php');
			return $form;
		}

	}
);