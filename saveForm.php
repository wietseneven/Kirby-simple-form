<?php

kirbytext::$tags['simpleForm'] = array(
	'attr' => array(
		'fields',
		'submit',
		'confirmation'
	),
	'html' => function($tag) {
		// If form was submitted go proces to form, else render the form
		if ($_POST["submitted"] == 'true') {
			require_once(__DIR__ . DS . 'lib' . DS . 'procesForm.php');
			// Clear post data to prevent double submissions
			header('Location:'.$_SERVER['PHP_SELF'].'?formres=true');
		} else if ($_GET['formres'] == 'true') {
			// If custom confirmation is set
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