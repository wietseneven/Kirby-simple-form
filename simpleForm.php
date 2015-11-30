<?php
require_once('lib/defineForm.php');
require_once('lib/processForm.php');
kirbytext::$tags['simpleForm'] = array(
	'attr' => array(
		'fields',
		'submit',
		'confirmation'
	),
	'html' => function($tag) {
		// If form was submitted go proces to form, else render the form
		if ($_POST) {

			$processForms = new processForm($tag->attr('simpleForm'), $_POST, $tag->page()->root());
			if ($processForms->saveForm() == 'success'){
				header('Location:'.$_SERVER['PHP_SELF'].'?sForm=true');
			}


		} else if ($_GET['sForm'] == true) {
			return $tag->attr('confirmation');
		} else {

			$simpleForm = new simpleForm($tag->attr('simpleForm'), $tag->attr('fields'), $tag->attr('submit'));
			return $simpleForm->createForm();

		}

	}
);