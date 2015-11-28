<?php

kirbytext::$tags['saveForm'] = array(
	'attr' => array(
		'fields'
	),
	'html' => function($tag) {
		if ($_POST["submitted"] == 'true') {

			require_once('procesForm.php');
		} else {
			return createForm($tag);
		}
	}
);

function createForm($tag) {

	$fields = explode(",", $tag->attr('fields'));
	$formName = $tag->attr('saveForm');

	$form = '<form action="#'.$formName.'" id="#'.$formName.'" method="post">';

	$fieldItteration = 0;
	foreach( $fields as $singleField) {

		// Create array from field type and field name
		$thisField = explode(":", $singleField);

		// Assign field type to variable
		$thisFieldType = $thisField[0];
		// Remove whitespace from string
		$thisFieldType = preg_replace('/\s+/', '', $thisFieldType);

		// Assign field name to variable
		$thisFieldName = $thisField[1];

		// create empty variable to save input HTML
		$input = '';

		if ($thisFieldType == 'textarea') {
			$input .= '<textarea name="'.$thisFieldName.'">';
		} else {
			$input .= '<input type="'.$thisFieldType.'"';
			$input .= ' placeholder="'.$thisFieldName.'" name="'.$thisFieldName.'"';
		}

		if ($thisFieldType == 'textarea') {
			$input .= '</textarea>';
		} else {
			$input .= '>';
		}

		// All HTML data of this input is set, pass it to the finale form var
		$form .= $input;
		$fields[$fieldItteration] = $thisField;
		$fieldItteration++;

	}

	$fileURI = $tag->page()->root().'/'.$formName.'.csv';
	$form .= '<input name="submitted" type="hidden" name="submitted" value="true">';
	$form .= '<input type="submit" value="Submit">';
	$form .= '</form>';

	return $form;
};