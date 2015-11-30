<?php
require_once('lib/procesForm.php');
kirbytext::$tags['simpleForm'] = array(
	'attr' => array(
		'fields',
		'submit',
		'confirmation'
	),
	'html' => function($tag) {
		// If form was submitted go proces to form, else render the form
		if ($_POST["submitted"] == 'true') {

			$processForms = new processForm($_POST, $tag->attr('simpleForm'),$tag->page()->root());
			echo $processForms->saveForm();

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