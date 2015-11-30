<?php
$fields = explode(",", $tag->attr('fields'));
$formName = $tag->attr('simpleForm');

$form = '<form action="#'.$formName.'" id="'.$formName.'" method="post">';

$fieldItteration = 0;
foreach( $fields as $singleField) {

	// Create array from field type and field name
	$thisField = explode(":", $singleField);
	$thisFieldParams = explode(".", $thisField[1]);
	$thisFieldClass = $thisFieldParams[1];
	$thisFieldName = $thisFieldParams[0];

	// Assign field type to variable
	$thisFieldType = $thisField[0];
	// Remove whitespace from string
	$thisFieldType = preg_replace('/\s+/', '', $thisFieldType);

	// Assign field name to variable


	// create empty variable to save input HTML
	$input = '';

	if ($thisFieldType == 'textarea') {
		$input .= '<textarea name="'.$thisFieldName.'" class="sFormInput '.$thisFieldClass.'" placeholder="'.$thisFieldName.'">';
	} else {
		$input .= '<input type="'.$thisFieldType.'" class="sFormInput '.$thisFieldClass.'" placeholder="'.$thisFieldName.'" name="'.$thisFieldName.'"';
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
if ($tag->attr('submit')) {
	$submitText = $tag->attr('submit');
} else {
	$submitText = 'Submit';
}

$form .= '<input name="submitted" type="hidden" name="submitted" value="true">';
$form .= '<input type="submit" value="'.$submitText.'">';
$form .= '</form>';